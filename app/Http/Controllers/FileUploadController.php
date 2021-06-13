<?php

namespace App\Http\Controllers;

use App\TemporaryFile;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        if($request->hasFile('cover_url')) {
            $file = $request->file('cover_url');
            $filename = uniqid() . '.jpg';
            $folder = uniqid() . '_' . now()->timestamp;
            $file->storeAs('/tmp/covers/' . $folder, $filename);

            $file->move(public_path('images'), $filename);

            TemporaryFile::create([
                'folder'        => $folder,
                'filename'      => $filename,
            ]);

            return $folder;
        }

        if ($request->hasFile('page_image_url')) {
            $folder = 'pages';
            foreach ($request->file('page_image_url') as $file) {
                $filename = uniqid() . '.jpg';
                $file->storeAs('/tmp/' . $folder, $filename);

                $file->move(public_path('images'), $filename);

                TemporaryFile::create([
                    'folder'        => $folder,
                    'filename'      => $filename,
                ]);
                return $filename;
            }
        }

        if ($request->hasFile('audio_url')) {
            $folder = 'audios';
            foreach ($request->file('audio_url') as $file) {
                $filename = uniqid() . '.mp3';
                $file->storeAs('/tmp/' . $folder, $filename);

                $file->move(public_path('audios'), $filename);

                TemporaryFile::create([
                    'folder'        => $folder,
                    'filename'      => $filename,
                ]);
                return $filename;
            }
        }

        if($request->hasFile('author_photo_url')) {
            $file = $request->file('author_photo_url');
            $filename = uniqid() . '.jpg';
            $folder = uniqid() . '_' . now()->timestamp;
            $file->storeAs('/tmp/authorPhoto/' . $folder, $filename);

            $file->move(public_path('images'), $filename);

            TemporaryFile::create([
                'folder'        => $folder,
                'filename'      => $filename,
            ]);

            return $folder;
        }

        if ($request->hasFile('image_url')) {
            $folder = 'activityImages';
            foreach ($request->file('image_url') as $file) {
                $filename = uniqid() . '.jpg';
                $file->storeAs('/tmp/' . $folder, $filename);

                $file->move(public_path('images'), $filename);

                TemporaryFile::create([
                    'folder'        => $folder,
                    'filename'      => $filename,
                ]);
                return $filename;
            }
        }


        return '';

    }
}
