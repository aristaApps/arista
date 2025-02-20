<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total user
        $userCount = User::count();

        // Mengambil nama database dari konfigurasi .env
        $databaseName = env('DB_DATABASE');

        // Inisialisasi variabel total file PDF
        $pdfCount = 0;

        // Kategori dokumen
        $categories = ['HKT', 'Keuangan', 'Kelembagaan', 'Kemahasiswaan', 'Akademik', 'SDPT'];
        $documentCounts = array_fill_keys($categories, 0); // Inisialisasi dengan 0 untuk setiap kategori

        try {
            // Mendapatkan semua tabel di database
            $tables = DB::select('SHOW TABLES');

            // Menampilkan hasil untuk memastikan formatnya
            Log::info("Tables: " . json_encode($tables)); // Tambahkan log

            // Memastikan nama kolom untuk mengambil nama tabel sesuai dengan database yang aktif
            $tableNameColumn = 'Tables_in_' . $databaseName;

            // Jika hasil query tables tidak memiliki data yang diharapkan
            if (empty($tables)) {
                throw new \Exception("No tables found in database {$databaseName}");
            }

            foreach ($tables as $table) {
                // Mengecek nama kolom yang ada dalam objek table
                Log::info("Table Object: " . json_encode($table));

                // Mendapatkan nama tabel dengan mengakses properti yang sesuai
                $tableName = isset($table->{$tableNameColumn}) ? $table->{$tableNameColumn} : null;

                // Pastikan tabel ditemukan, jika tidak, lompat ke tabel berikutnya
                if (!$tableName) {
                    continue;
                }

                // Mendapatkan semua kolom dari tabel
                $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

                // Menentukan kolom yang relevan untuk file (seperti file_path, filename, document_name)
                $fileColumns = array_filter($columns, function ($column) {
                    return in_array($column, ['filename', 'file_path', 'document_name']);
                });

                // Menghitung file PDF di setiap tabel
                foreach ($fileColumns as $fileColumn) {
                    // Total PDF tanpa memfilter kategori
                    $pdfCount += DB::table($tableName)
                        ->where($fileColumn, 'like', "%.pdf")
                        ->count();

                    // Total PDF berdasarkan kategori
                    foreach ($categories as $category) {
                        $documentCounts[$category] += DB::table($tableName)
                            ->where($fileColumn, 'like', "%{$category}%.pdf")
                            ->count();
                    }
                }
            }
        } catch (\Exception $e) {
            // Menangani exception yang terjadi dan mengirim pesan error
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // Data untuk dikirimkan ke view
        return view('dashboard', compact('userCount', 'pdfCount', 'documentCounts'));
    }
}
