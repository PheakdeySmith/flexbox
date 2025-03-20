<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $settings = Setting::getAllSettings();
        return view('backend.settings.edit', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        try {
            $request->validate([
                'site_name' => 'nullable|string|max:255',
                'site_title' => 'required|string|max:255',
                'copyright_text' => 'nullable|string',
                'favicon' => 'nullable|file|mimes:ico,png,jpg,jpeg,gif,svg,webp|max:2048',
                'logo' => 'nullable|file|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
                'apple_store_link' => 'nullable|url|max:255',
                'google_play_link' => 'nullable|url|max:255',
                'twitter_link' => 'nullable|url|max:255',
                'facebook_link' => 'nullable|url|max:255',
                'instagram_link' => 'nullable|url|max:255',
                'whatsapp_link' => 'nullable|url|max:255',
            ]);

            $settings = Setting::getAllSettings();

            Log::info('Files in request:', ['files' => $request->allFiles()]);

            // Handle favicon upload
            if ($request->hasFile('favicon') && $request->file('favicon')->isValid()) {
                try {
                    Log::info('Processing favicon upload', ['mime' => $request->file('favicon')->getMimeType()]);

                    // Make sure the directory exists
                    Storage::disk('public')->makeDirectory('settings', 0755, true);

                    // Delete old favicon if exists
                    if ($settings->favicon && Storage::disk('public')->exists($settings->favicon)) {
                        Storage::disk('public')->delete($settings->favicon);
                    }

                    $faviconPath = $request->file('favicon')->store('settings', 'public');
                    Log::info('Favicon stored at: ' . $faviconPath);
                    $settings->favicon = $faviconPath;
                } catch (\Exception $e) {
                    Log::error('Favicon upload failed: ' . $e->getMessage(), ['exception' => $e]);
                    return redirect()->back()->with('error', 'Favicon upload failed: ' . $e->getMessage());
                }
            } else if ($request->hasFile('favicon')) {
                Log::error('Favicon file is not valid', ['errors' => $request->file('favicon')->getErrorMessage()]);
                return redirect()->back()->with('error', 'Favicon file is not valid: ' . $request->file('favicon')->getErrorMessage());
            } else {
                Log::info('No favicon file in request');
            }

            // Handle logo upload
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                try {
                    Log::info('Processing logo upload', ['mime' => $request->file('logo')->getMimeType()]);

                    // Make sure the directory exists
                    Storage::disk('public')->makeDirectory('settings', 0755, true);

                    // Delete old logo if exists
                    if ($settings->logo && Storage::disk('public')->exists($settings->logo)) {
                        Storage::disk('public')->delete($settings->logo);
                    }

                    $logoPath = $request->file('logo')->store('settings', 'public');
                    Log::info('Logo stored at: ' . $logoPath);
                    $settings->logo = $logoPath;
                } catch (\Exception $e) {
                    Log::error('Logo upload failed: ' . $e->getMessage(), ['exception' => $e]);
                    return redirect()->back()->with('error', 'Logo upload failed: ' . $e->getMessage());
                }
            } else if ($request->hasFile('logo')) {
                Log::error('Logo file is not valid', ['errors' => $request->file('logo')->getErrorMessage()]);
                return redirect()->back()->with('error', 'Logo file is not valid: ' . $request->file('logo')->getErrorMessage());
            } else {
                Log::info('No logo file in request');
            }

            // Update other fields
            $settings->site_name = $request->site_name;
            $settings->site_title = $request->site_title;
            $settings->copyright_text = $request->copyright_text;
            $settings->apple_store_link = $request->apple_store_link;
            $settings->google_play_link = $request->google_play_link;
            $settings->twitter_link = $request->twitter_link;
            $settings->facebook_link = $request->facebook_link;
            $settings->instagram_link = $request->instagram_link;
            $settings->whatsapp_link = $request->whatsapp_link;

            $settings->save();

            return redirect()->route('settings.edit')->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            Log::error('Settings update failed: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Settings update failed: ' . $e->getMessage());
        }
    }
}
