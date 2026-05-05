<?php
// ═══════════════════════════════════════════════════════════
// ProgramController.php
// ═══════════════════════════════════════════════════════════
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

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
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable',
        ]);

        Program::create([
            'name'        => $request->name,
            'icon'        => $request->icon,
            'description' => $request->description,
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
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable',
        ]);

        $program->update([
            'name'        => $request->name,
            'icon'        => $request->icon,
            'description' => $request->description,
            'sort_order'  => $request->input('sort_order', 0),
            'is_active'   => $request->has('is_active'),
        ]);

        return back()->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return back()->with('success', 'Program berhasil dihapus.');
    }
}