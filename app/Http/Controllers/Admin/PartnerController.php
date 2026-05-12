<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('sort_order')->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:200',
            'website' => 'nullable|url|max:200',
            'logo'    => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('partners', 'public');
        }

        $nextOrder = (Partner::max('sort_order') ?? 0) + 1;

        Partner::create([
            'name'       => $request->name,
            'website'    => $request->website,
            'sort_order' => $nextOrder,
            'logo_path'  => $logoPath,
            'is_visible' => true,
        ]);

        return back()->with('success', 'Mitra berhasil ditambahkan!');
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name'       => 'required|string|max:200',
            'website'    => 'nullable|url|max:200',
            'sort_order' => 'nullable|integer',
            'is_visible' => 'nullable|boolean',
            'logo'       => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $data = [
            'name'       => $request->name,
            'website'    => $request->website,
            'sort_order' => $request->sort_order ?? 0,
            'is_visible' => $request->boolean('is_visible', true),
        ];

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        return back()->with('success', 'Mitra berhasil diperbarui!');
    }

    public function toggleVisible(Partner $partner)
    {
        $partner->update(['is_visible' => !$partner->is_visible]);
        return back()->with('success', 'Status mitra diperbarui.');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return back()->with('success', 'Mitra berhasil dihapus.');
    }
}