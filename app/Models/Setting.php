<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'description'
    ];

    /**
     * Mendapatkan nilai setting berdasarkan key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Mengatur nilai setting
     *
     * @param string $key
     * @param mixed $value
     * @param string|null $description
     * @return bool
     */
    public static function setValue(string $key, $value, ?string $description = null)
    {
        $setting = self::firstOrNew(['key' => $key]);
        $setting->value = $value;
        
        if ($description && !$setting->exists) {
            $setting->description = $description;
        }
        
        return $setting->save();
    }
} 