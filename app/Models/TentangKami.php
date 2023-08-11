<?php

namespace App\Models;

use CodeIgniter\Model;

class TentangKami extends Model
{
    protected $table      = 'tb_tentang_kami';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_usaha', 'no_tlpn', 'deskripsi', 'foto', 'alamat_usaha'];
}