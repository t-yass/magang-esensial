<?php
// ═══════════════════════════════════════════════════════════
// ProgramController.php
// ═══════════════════════════════════════════════════════════
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('sort_order')->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:200',
            'icon'        => 'required|string|max:50',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video'       => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable',
        ]);

        $photoPath = null;
        $videoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('programs/photos', 'public');
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('programs/videos', 'public');
        }

        Program::create([
            'name'        => $request->name,
            'icon'        => $request->icon,
            'description' => $request->description,
            'photo_path'  => $photoPath,
            'video_path'  => $videoPath,
            'sort_order'  => $request->input('sort_order', 0),
            'is_active'   => $request->has('is_active'),
        ]);

        return back()->with('success', 'Program berhasil ditambahkan!');
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name'        => 'required|string|max:200',
            'icon'        => 'required|string|max:50',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video'       => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable',
        ]);

        $photoPath = $program->photo_path;
        $videoPath = $program->video_path;

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('programs/photos', 'public');
        }

        if ($request->hasFile('video')) {
            // Hapus video lama jika ada
            if ($videoPath && Storage::disk('public')->exists($videoPath)) {
                Storage::disk('public')->delete($videoPath);
            }
            $videoPath = $request->file('video')->store('programs/videos', 'public');
        }

        $program->update([
            'name'        => $request->name,
            'icon'        => $request->icon,
            'description' => $request->description,
            'photo_path'  => $photoPath,
            'video_path'  => $videoPath,
            'sort_order'  => $request->input('sort_order', 0),
            'is_active'   => $request->has('is_active'),
        ]);

        return back()->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy(Program $program)
    {
        // Hapus file foto dan video jika ada
        if ($program->photo_path && Storage::disk('public')->exists($program->photo_path)) {
            Storage::disk('public')->delete($program->photo_path);
        }

        if ($program->video_path && Storage::disk('public')->exists($program->video_path)) {
            Storage::disk('public')->delete($program->video_path);
        }

        $program->delete();
        return back()->with('success', 'Program berhasil dihapus.');
    }
}