<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_title',
        'copyright_text',
        'favicon',
        'logo',
        'apple_store_link',
        'google_play_link',
    ];

    /**
     * Get a setting by key
     *
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        $setting = self::first();
        if ($setting) {
            return $setting->{$key} ?? null;
        }
        return null;
    }

    /**
     * Get all settings as an array
     *
     * @return array
     */
    public static function getAllSettings()
    {
        $settings = self::first();
        if (!$settings) {
            $settings = self::create([
                'site_title' => 'StreamIT',
                'copyright_text' => '© 2025 StreamIT. All Rights Reserved.',
            ]);
        }
        return $settings;
    }
}
