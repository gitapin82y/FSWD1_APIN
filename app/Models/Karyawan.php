<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $guarded = [];

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'nomor_induk', 'nomor_induk');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($karyawan) {
            $nomorUrut = self::max('id') + 1;
            $karyawan->nomor_induk = 'IP06' . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);
            // IP06 -> 001
        });
    }
}
