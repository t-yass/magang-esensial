<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:300',
            'category'   => 'required|string|max:100',
            'event_date' => 'nullable|date',
            'content'    => 'nullable|string',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $this->storeThumbnail($request->file('thumbnail'));
        }

        BlogPost::create([
            'title'          => $request->title,
            'category'       => $request->category,
            'event_date'     => $request->event_date,
            'content'        => $request->content,
            'thumbnail_path' => $thumbnailPath,
            'published_at'   => now(),
        ]);

        return back()->with('success', 'Artikel berhasil disimpan!');
    }

    public function update(Request $request, BlogPost $post)
    {
        $request->validate([
            'title'      => 'required|string|max:300',
            'category'   => 'required|string|max:100',
            'event_date' => 'nullable|date',
            'content'    => 'nullable|string',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $data = [
            'title'        => $request->title,
            'category'     => $request->category,
            'event_date'   => $request->event_date,
            'content'      => $request->content,
            'published_at' => $post->published_at ?? now(),
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $this->storeThumbnail($request->file('thumbnail'));
        }

        $post->update($data);

        return back()->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(BlogPost $post)
    {
        $post->delete();
        return back()->with('success', 'Artikel berhasil dihapus.');
    }

    private function storeThumbnail($file): ?string
    {
        $path = $file->getRealPath();
        $storageName = uniqid('thumb_') . '.' . $file->getClientOriginalExtension();

        if ($file->getSize() <= 3 * 1024 * 1024) {
            return Storage::disk('public')->putFileAs('blog', new File($path), $storageName);
        }

        $image = $this->createImageResource($file);
        if (! $image) {
            return Storage::disk('public')->putFileAs('blog', new File($path), $storageName);
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $maxWidth = 1920;
        $scale = $width > $maxWidth ? $maxWidth / $width : 1;
        $newWidth = max(600, intval($width * $scale));
        $newHeight = intval($height * $scale);

        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($resized, false);
        imagesavealpha($resized, true);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $tempPath = tempnam(sys_get_temp_dir(), 'blogthumb_');
        $quality = 85;
        $extension = strtolower($file->getClientOriginalExtension());

        do {
            switch ($extension) {
                case 'png':
                    imagepng($resized, $tempPath, 6);
                    break;
                case 'webp':
                    imagewebp($resized, $tempPath, $quality);
                    break;
                default:
                    imagejpeg($resized, $tempPath, $quality);
            }
            $quality -= 10;
        } while (filesize($tempPath) > 3 * 1024 * 1024 && $quality > 30);

        imagedestroy($image);
        imagedestroy($resized);

        $stored = Storage::disk('public')->putFileAs('blog', new File($tempPath), $storageName);
        @unlink($tempPath);

        return $stored;
    }

    private function createImageResource($file)
    {
        $path = $file->getRealPath();
        $info = getimagesize($path);

        if (! $info) {
            return null;
        }

        switch ($info[2]) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($path);
            case IMAGETYPE_PNG:
                return imagecreatefrompng($path);
            case IMAGETYPE_WEBP:
                return imagecreatefromwebp($path);
            default:
                return null;
        }
    }
}