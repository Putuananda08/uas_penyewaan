<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sewa extends Model
{
    use HasFactory;
    protected $table = 'sewa';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'customer_id', 'mobil_id', 'tgl_pinjam', 'tgl_kembali', 'total_bayar'];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function mobil()
    {
        return $this->belongsTo(mobil::class, 'mobil_id');
    }
}
