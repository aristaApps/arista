<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        // Mendapatkan semua tabel di database
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            // Mendapatkan nama tabel
            $tableName = $table->{'Tables_in_' . $databaseName};

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

        // Data untuk dikirimkan ke view
        return view('dashboard', compact('userCount', 'pdfCount', 'documentCounts'));
    }
}
