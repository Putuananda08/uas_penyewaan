<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobil extends Model
{
    use HasFactory;
    protected $table = 'mobil';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'no_plat', 'jenis', 'merk', 'warna'];

    public function sewa() {
        return $this->hasMany(sewa::class);
    }
}
