<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang extends Model
{
    protected $table      = 'tb_barang';
    protected $primaryKey = 'kd_barang';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_barang', 'harga_beli','harga_jual', 'stok', 'gambar','keterangan', 'created_at', 'updated_at'];
}