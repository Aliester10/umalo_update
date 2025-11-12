<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandPartner extends Model
{
    protected $table = 'brand_partner'; // pastikan sesuai nama tabel
    protected $fillable = ['gambar', 'type', 'url', 'nama'];
    public $timestamps = false; // karena sebagian datanya null untuk created_at/updated_at
}
