<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unique_code'];

    /**
     * Relasi dengan tabel pesanan_details.
     */
    public function pesananDetails()
    {
        return $this->hasMany(PesananDetail::class);
    }
}
