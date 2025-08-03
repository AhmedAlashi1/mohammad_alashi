<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function backupAndDownload()
    {

        Artisan::call('backup:run --only-db');

        $disk = Storage::disk('local');
        $files = $disk->allFiles('Laravel');

        // ترتيب الملفات حسب التاريخ (الأحدث أولاً)
        usort($files, function ($a, $b) use ($disk) {
            return $disk->lastModified($b) - $disk->lastModified($a);
        });

        $latestBackup = $files[0] ?? null;

        if (!$latestBackup || !$disk->exists($latestBackup)) {
            return redirect()->back()->with('error', 'Backup file not found!');
        }
        dd($latestBackup);

        $path = storage_path('app/' . $latestBackup);
        $filename = basename($latestBackup);
        return response()->download($path, $filename, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
    public function createBackup()
    {
        Artisan::call('backup:run --only-db');
        return redirect()->back()->with('success', 'Backup created successfully.');
    }

    public function downloadLatestBackup()
    {
        $disk = Storage::disk('local');
        $files = $disk->allFiles('Laravel');

        usort($files, fn($a, $b) => $disk->lastModified($b) - $disk->lastModified($a));
        $latestBackup = $files[0] ?? null;

        if (!$latestBackup || !$disk->exists($latestBackup)) {
            return response()->json(['error' => 'Backup file not found'], 404);
        }

        $path = storage_path('app/' . $latestBackup);

        return response()->file($path); // لا تستخدم download
    }

}
