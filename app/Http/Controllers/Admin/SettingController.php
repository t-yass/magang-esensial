<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // ─── Hero ────────────────────────────────────────────────────────────────

    public function hero()
    {
        $s = SiteSetting::all_settings();
        return view('admin.settings.hero', compact('s'));
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'hero_title'       => 'required|string|max:200',
            'hero_tagline'     => 'required|string|max:200',
            'hero_description' => 'nullable|string',
            'hero_cta_text'    => 'nullable|string|max:100',
            'hero_cta_link'    => 'nullable|string|max:200',
            'founder_photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only([
            'hero_title', 'hero_tagline', 'hero_description',
            'hero_cta_text', 'hero_cta_link',
        ]);

        if ($request->hasFile('founder_photo')) {
            $path = $request->file('founder_photo')->store('images', 'public');
            $data['founder_photo'] = $path;
        }

        SiteSetting::setMany($data);

        return back()->with('success', 'Hero section berhasil disimpan!');
    }

    // ─── About / Founder ─────────────────────────────────────────────────────

    public function about()
    {
        $s     = SiteSetting::all_settings();
        $certs = Certification::orderBy('sort_order')->get();
        return view('admin.settings.about', compact('s', 'certs'));
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'founder_name'      => 'required|string|max:200',
            'founder_position'  => 'required|string|max:200',
            'founder_instagram' => 'nullable|string|max:100',
            'founder_whatsapp'  => 'nullable|string|max:20',
            'stat_corporate'    => 'nullable|string|max:20',
            'stat_government'   => 'nullable|string|max:20',
            'stat_education'    => 'nullable|string|max:20',
            'profile_photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only([
            'founder_name', 'founder_position',
            'founder_instagram', 'founder_whatsapp',
            'stat_corporate', 'stat_government', 'stat_education',
        ]);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('images', 'public');
            $data['founder_photo'] = $path;
        }

        SiteSetting::setMany($data);

        // Sync certifications
        if ($request->has('certs')) {
            Certification::truncate();
            foreach (array_filter($request->input('certs', [])) as $i => $title) {
                Certification::create([
                    'title'      => $title,
                    'sort_order' => $i + 1,
                    'is_visible' => true,
                ]);
            }
        }

        return back()->with('success', 'Data founder berhasil disimpan!');
    }

    // ─── Contact ─────────────────────────────────────────────────────────────

    public function contact()
    {
        $s = SiteSetting::all_settings();
        return view('admin.settings.contact', compact('s'));
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'contact_whatsapp'  => 'nullable|string|max:20',
            'contact_instagram' => 'nullable|string|max:100',
            'contact_email'     => 'nullable|email|max:200',
            'contact_address'   => 'nullable|string',
        ]);

        SiteSetting::setMany($request->only([
            'contact_whatsapp', 'contact_instagram',
            'contact_email', 'contact_address',
        ]));

        return back()->with('success', 'Informasi kontak berhasil disimpan!');
    }

    // ─── Appearance ──────────────────────────────────────────────────────────

    public function appearance()
    {
        $s = SiteSetting::all_settings();
        return view('admin.settings.appearance', compact('s'));
    }

    public function updateAppearance(Request $request)
    {
        $request->validate([
            'font_heading'     => 'required|string|max:100',
            'font_body'        => 'required|string|max:100',
            'font_size'        => 'required|integer|min:12|max:24',
            'color_primary'    => 'required|string|max:20',
            'color_accent'     => 'required|string|max:20',
            'color_background' => 'required|string|max:20',
            'color_text'       => 'required|string|max:20',
            'site_title'       => 'nullable|string|max:200',
            'site_description' => 'nullable|string',
        ]);

        SiteSetting::setMany($request->only([
            'font_heading', 'font_body', 'font_size',
            'color_primary', 'color_accent', 'color_background', 'color_text',
            'site_title', 'site_description',
        ]));

        return back()->with('success', 'Pengaturan tampilan berhasil disimpan!');
    }
}