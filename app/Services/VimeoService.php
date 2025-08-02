<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;
use Vimeo\Exceptions\VimeoUploadException;
use Vimeo\Vimeo;

class VimeoService
{
    protected $client;


    public function __construct()
    {
        $this->client = new Vimeo(
            config('services.vimeo.client_id'),
            config('services.vimeo.client_secret'),
            config('services.vimeo.access_token')
        );
    }

    public function uploadVideo(UploadedFile $file): ?array
    {
        try {
            // Full path to the file
            $filePath = $file->getRealPath();

            // رفع الفيديو
            $uri = $this->client->upload($filePath, [
                'name' => $file->getClientOriginalName(),
                'privacy' => [
                    'view' => 'unlisted' // or 'anybody' or 'nobody' or 'password'
                ]
            ]);

            // جلب تفاصيل الفيديو
            $videoData = $this->client->request($uri . '?fields=link,duration');

            return [
                'link'     => $videoData['body']['link'] ?? null,
                'duration' => $videoData['body']['duration'] ?? null,
            ];

        } catch (VimeoUploadException $e) {
//            logger()->error('Vimeo Upload Error: ' . $e->getMessage());
            dd('Vimeo Upload Error: ' . $e->getMessage(), $e->getTraceAsString());
            return null;
        } catch (\Exception $e) {
//            logger()->error('General Vimeo Error: ' . $e->getMessage());
            dd('Vimeo Error: ' . $e->getMessage(), $e->getTraceAsString());
            return null;
        }
    }
}
