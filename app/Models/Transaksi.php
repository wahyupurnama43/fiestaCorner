<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends Model
{
    protected $table      = 'tb_transaksi';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kd_pesanan','id_pesanan','id_pembeli', 'jml_barang', 'kd_barang', 'total_harga','bukti_pembayaran', 'status_transaksi','tgl_transaksi', 'updated_at','tanggal_kirim','tanggal_sampai'];
}