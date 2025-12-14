<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    // migration doesn't include timestamps
    public $timestamps = false;

    protected $fillable = [
        'namaMenu',
        'harga',
        'kategori',
    ];
}
