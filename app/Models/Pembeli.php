<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembeli extends Model
{
    protected $table      = 'tb_pembeli';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_pembeli', 'kd_pesanan', 'nama_pembeli', 'telp', 'alamat', 'created_at', 'updated_at'];
}