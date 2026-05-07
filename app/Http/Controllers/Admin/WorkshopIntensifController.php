<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkshopIntensif;
use App\Models\WorkshopIntensifPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkshopIntensifController extends Controller
{
    public function index()
    {
        $workshop = WorkshopIntensif::first() ?? WorkshopIntensif::create([
            'description' => 'Pelatihan yang diikuti oleh berbagai instansi untuk dapat mewujudkan sebuah pelayanan yang memuaskan dan tak terlupakan bagi para client, serta meningkatkan citra positif instansi di antara para kompetitor yang ada.',
            'taglines' => ['Pelayanan Prima', 'Citra Positif', 'Kompetitif', 'Profesional'],
            'is_visible' => true,
        ]);
        $photos = WorkshopIntensifPhoto::where('workshop_intensif_id', $workshop->id)->orderBy('sort_order')->get();
        return view('admin.workshop-intensif.index', compact('workshop', 'photos'));
    }

    public function update(Request $request, WorkshopIntensif $workshop)
    {
        $request->validate([
            'description' => 'nullable|string',
            'taglines' => 'nullable|string',
            'is_visible' => 'nullable',
        ]);

        // Convert comma-separated string to array
        $taglines = $request->taglines ? array_map('trim', explode(',', $request->taglines)) : [];

        $workshop->update([
            'description' => $request->description,
            'taglines' => $taglines,
            'is_visible' => $request->has('is_visible'),
        ]);

        return back()->with('success', 'Workshop Intensif berhasil diperbarui!');
    }

    public function uploadPhoto(Request $request, WorkshopIntensif $workshop)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,webp|max:5120',
            'alt_text' => 'nullable|string|max:200',
        ]);

        $file = $request->file('file');
        $path = $file->store('workshop-intensif', 'public');

        // Get current visible photos count
        $visibleCount = WorkshopIntensifPhoto::where('workshop_intensif_id', $workshop->id)
            ->where('is_visible', true)
            ->count();

        // If we already have 4 visible photos, hide the oldest one
        if ($visibleCount >= 4) {
            $oldestVisible = WorkshopIntensifPhoto::where('workshop_intensif_id', $workshop->id)
                ->where('is_visible', true)
                ->orderBy('created_at', 'asc')
                ->first();
            if ($oldestVisible) {
                $oldestVisible->update(['is_visible' => false]);
            }
        }

        WorkshopIntensifPhoto::create([
            'workshop_intensif_id' => $workshop->id,
            'file_path' => $path,
            'alt_text' => $request->input('alt_text', 'Workshop Photo'),
            'sort_order' => WorkshopIntensifPhoto::where('workshop_intensif_id', $workshop->id)->max('sort_order') + 1,
            'is_visible' => true,
        ]);

        return back()->with('success', 'Foto berhasil diupload!');
    }

    public function deletePhoto(WorkshopIntensifPhoto $photo)
    {
        Storage::disk('public')->delete($photo->file_path);
        $photo->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function togglePhotoVisibility(WorkshopIntensifPhoto $photo)
    {
        $photo->update(['is_visible' => !$photo->is_visible]);
        return back()->with('success', 'Status foto berhasil diubah.');
    }
}
