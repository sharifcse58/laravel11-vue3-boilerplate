<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getSettings()
    {
        $settings = Setting::first();
        return response()->json($settings);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'company_name' => 'nullable|string|max:255',
            'card_color' => 'nullable|string|max:7', // Hex color
        ]);

        $settings = Setting::firstOrCreate([]);
        $settings->update($request->only('company_name', 'card_color'));

        return response()->json(['message' => 'Settings updated successfully', 'settings' => $settings]);
    }
}
