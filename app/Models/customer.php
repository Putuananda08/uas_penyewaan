<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'nama_customer', 'alamat', 'no_telp', 'email'];
   
    public function sewa(){
        return $this->hasMany(sewa::class);
    }
}
