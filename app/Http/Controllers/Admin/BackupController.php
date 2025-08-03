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
        // تنفيذ الباك اب
        Artisan::call('backup:run --only-db');

        // الحصول على أحدث ملف باك أب
        $files = Storage::disk('local')->files('Laravel');
        $latestBackup = end($files);

        // التأكد من وجود الباك أب
        if (!$latestBackup || !Storage::disk('local')->exists($latestBackup)) {
            return redirect()->back()->with('error', 'Backup file not found!');
        }

        // تنزيل الملف
        return Storage::disk('local')->download($latestBackup);
    }
}
}
