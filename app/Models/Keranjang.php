<?php

namespace App\Models;

use CodeIgniter\Model;

class Keranjang extends Model
{
    protected $table      = 'tb_keranjang';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_barang', 'id_pembeli', 'quantity_beli', 'total_harga','status_dikeranjang','created_at','updated_at'];
}