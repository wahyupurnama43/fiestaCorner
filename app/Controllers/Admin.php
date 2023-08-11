<?php

namespace App\Controllers;


use Config\Database;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\TentangKami;
use Myth\Auth\Config\Services;
use App\Controllers\BaseController;

class Admin extends BaseController
{
    protected $db, $builder;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $builder = $this->db->table('tb_barang');
        $builder->selectCount('kd_barang');
        $query = $builder->get();
        $data['total_produk'] = $query->getRow();

        $builder = $this->db->table('tb_transaksi');
        $builder->selectSum('total_harga');
        $builder->where("status_transaksi = 'PROSES KIRIM' OR status_transaksi = 'SELESAI'");
        $query = $builder->get();
        $data['total_penjualan'] = $query->getRow();

        $builder = $this->db->table('tb_transaksi');
        $builder->selectCount('total_harga');
        $builder->where("status_transaksi <> 'PROSES KIRIM'");
        $query = $builder->get();
        $data['pending_payment'] = $query->getRow();

        $builder = $this->db->table('tb_transaksi');
        $builder->selectCount('total_harga');
        $builder->where("status_transaksi = 'SELESAI'");
        $query = $builder->get();
        $data['success_payment'] = $query->getRow();

        return view('admin/index', $data);
    }

    public function products_list()
    {
        $data['title'] = 'Produk list';

        $builder = $this->db->table('tb_barang');
        $query   = $builder->get();
        $data['barang'] = $query->getResult();

        return view('admin/products', $data);
    }

    public function tambah_produk()
    {
        $data['title'] = 'Produk list';
        $barang = new Barang;

        // VALIDASI 
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama_barang'   => 'required',
            'harga_beli'    => 'required',
            'harga_jual'    => 'required',
            'stok'          => 'required',
            'keterangan'    => 'required',
            'image'         => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,4096]',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // END VALIDASI


        if ($isDataValid) {

            $image = $this->request->getFile('image');
            $fileName = time() . $image->getClientName();

            $image->move('mystyle/produk/', $fileName);

            $barang->insert([
                "nama_barang"        => $this->request->getPost('nama_barang'),
                "harga_beli"         => $this->request->getPost('harga_beli'),
                "harga_jual"         => $this->request->getPost('harga_jual'),
                "stok"               => $this->request->getPost('stok'),
                "keterangan"         => $this->request->getPost('keterangan'),
                "gambar"             => $fileName,
                "created_at"         => date('Y-m-d'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Produk berhasil ditambahkan.');

            return redirect('admin/products_list', $data);
        }

        return redirect('admin/products_list', $data);
    }

    public function edit_produk($kd_barang = 0)
    {
        $data['title'] = 'Produk list';
        $barang = new Barang;

        $builder = $this->db->table('tb_barang');
        $builder->where('kd_barang', $kd_barang);
        $query = $builder->get();
        $data['barang'] = $query->getRow();


        // VALIDASI 
        $validation =  \Config\Services::validation();

        if (empty($this->request->getPost('gambar'))) {
            $validation->setRules([
                'nama_barang'   => 'required',
                'harga_beli'    => 'required',
                'harga_jual'    => 'required',
                'stok'          => 'required',
                'keterangan'    => 'required',
            ]);
        } else {
            $validation->setRules([
                'nama_barang'   => 'required',
                'harga_beli'    => 'required',
                'harga_jual'    => 'required',
                'stok'          => 'required',
                'keterangan'    => 'required',
                'image'         => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,4096]'
            ]);
        }
        $isDataValid = $validation->withRequest($this->request)->run();
        // END VALIDASI


        if ($isDataValid) {

            if (empty($this->request->getPost('gambar'))) {
                $fileName = $data['barang']->gambar;
            } else {
                $image = $this->request->getFile('image');
                $fileName = time() . $image->getClientName();

                $image->move('mystyle/produk/', $fileName);
            }

            $barang->update($kd_barang, [
                "nama_barang"        => $this->request->getPost('nama_barang'),
                "harga_beli"         => $this->request->getPost('harga_beli'),
                "harga_jual"         => $this->request->getPost('harga_jual'),
                "stok"               => $this->request->getPost('stok'),
                "keterangan"         => $this->request->getPost('keterangan'),
                "gambar"             => $fileName,
                "created_at"         => date('Y-m-d'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Produk berhasil diedit.');

            return redirect('admin/products_list', $data);
        }

        return redirect('admin/products_list', $data);
    }

    public function delete_produk($kd_barang)
    {
        $barang = new Barang();
        $barang->delete($kd_barang);
        //flash message
        session()->setFlashdata('message', 'Produk Berhasil dihapus.');

        return redirect('admin/products_list');
    }

    public function order_list()
    {
        $data['title'] = 'Orders list';

        $builder = $this->db->table('tb_transaksi');
        $builder->selectSum('jml_barang');
        $builder->selectSum('total_harga');
        $builder->join('tb_pembeli', 'tb_pembeli.kd_pesanan = tb_transaksi.kd_pesanan');
        $builder->select('tb_transaksi.kd_pesanan,nama_pembeli,telp,alamat,bukti_pembayaran,status_transaksi,tanggal_kirim,tanggal_sampai');
        $builder->groupBy('kd_pesanan');
        $builder->orderBy('tb_transaksi.id', 'ASC');
        $query   = $builder->get();
        $data['kd_pesanan'] = $query->getResult();

        return view('admin/orders_list', $data);
    }

    public function ubah_status_pesanan($kd_pesanan = 0)
    {
        $data['title'] = 'Ubah status order';

        $transaksi = new Transaksi();
        $barang    = new Barang();


        // VALIDASI 
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'tanggal_kirim' => 'required',
            'tanggal_sampai'   => 'required',
            'status_transaksi' => 'required',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // END VALIDASI

        if ($isDataValid) {

            $builder = $this->db->table('tb_transaksi');
            $builder->join('tb_barang', 'tb_barang.kd_barang = tb_transaksi.kd_barang');
            $builder->where('kd_pesanan', $kd_pesanan);
            $query = $builder->get();
            $data['transaksi'] = $query->getResult();

            foreach ($query->getResult() as $data) {

                $transaksi->update($data->id, [
                    "tanggal_kirim"        => $this->request->getPost('tanggal_kirim'),
                    "tanggal_sampai"       =>  $this->request->getPost('tanggal_sampai'),
                    "status_transaksi"     => $this->request->getPost('status_transaksi'),
                    "updated_at"           => date('Y-m-d H:i:s')
                ]);


                //update stok produk
                // $builder = $this->db->table('tb_barang');
                // $builder->where('kd_barang', $data->kd_barang);  
                // $query = $builder->get();
                // var_dump($query);
                // die;
                // $data['barang'] = $query->getResult();

                $hasilpengurangan = $data->stok - $data->jml_barang;

                $barang->update($data->kd_barang, [
                    "stok"           => $hasilpengurangan,
                    "updated_at"     => date('Y-m-d H:i:s'),
                ]);
                //end update stok

            }
            //flash message
            session()->setFlashdata('message', 'Stauts produk Berhasil diedit.');

            return redirect('admin/orders_list', $data);
        }

        return redirect('admin/orders_list', $data);
    }

    public function orders_delete($kd_pesanan)
    {

        $builder = $this->db->table('tb_transaksi');
        $builder->where('kd_pesanan', $kd_pesanan);
        $builder->delete();
        //flash message
        session()->setFlashdata('message', 'Orders Berhasil dihapus.');

        return redirect('admin/orders_list');
    }

    public function laporan()
    {
        $data['title'] = 'laporan';

        $builder = $this->db->table('tb_transaksi');
        $builder->join('tb_barang', 'tb_barang.kd_barang = tb_transaksi.kd_barang');
        $builder->where('status_transaksi', 'SELESAI');
        $query   = $builder->get();
        $data['transaksi'] = $query->getResult();

        $builder = $this->db->table('tb_transaksi');
        $builder->selectSum('total_harga');
        $query   = $builder->get();
        $data['total'] = $query->getResult();

        return view('admin/laporan', $data);
    }

    public function laporan_filter_tanggal()
    {
        $data['title'] = 'laporan';

        $builder = $this->db->table('tb_transaksi');
        $builder->join('tb_barang', 'tb_barang.kd_barang = tb_transaksi.kd_barang');
        $builder->where("status_transaksi ='SELESAI'AND tgl_transaksi >= '" . $this->request->getPost('dari_tanggal') . "' AND tgl_transaksi < '" . $this->request->getPost('sampai_tanggal') . "' ");
        $query   = $builder->get();
        $data['transaksi'] = $query->getResult();

        $builder = $this->db->table('tb_transaksi');
        $builder->selectSum('total_harga');
        $builder->where("tgl_transaksi >= '" . $this->request->getPost('dari_tanggal') . "' AND tgl_transaksi < '" . $this->request->getPost('sampai_tanggal') . "' ");
        $query   = $builder->get();
        $data['total'] = $query->getResult();


        return view('admin/laporan', $data);
    }

    public function tentangKami()
    {
        $data['title'] = 'Tentang Kami';
        $builder         = $this->db->table('tb_tentang_kami');
        $query           = $builder->get();
        $data['tentang'] = $query->getRow();
        return view('admin/tentangKami', $data);
    }
    public function updateTentangKami()
    {
        $tentangKami     = new TentangKami;
        $builder         = $this->db->table('tb_tentang_kami');
        $query           = $builder->get();
        $data['tentang'] = $query->getRow();


        $validation =  \Config\Services::validation();
        if ($_FILES['foto_usaha']['error'] > 0) {
            $validation->setRules([
                'nama_usaha'   => 'required',
                'alamat_usaha' => 'required',
                'phone_usaha'  => 'required',
            ]);
        } else {
            $validation->setRules([
                'nama_usaha'   => 'required',
                'alamat_usaha' => 'required',
                'phone_usaha'  => 'required',
            ]);
        }

        $isDataValid = $validation->withRequest($this->request)->run();
        // END VALIDASI
        if ($isDataValid) {
            $fileName = '';
            if ($_FILES['foto_usaha']['error'] > 0) {
                $fileName = $data['tentang']->foto;
            } else {
                $image    = $this->request->getFile('foto_usaha');
                $fileName = time() . $image->getClientName();
                $image->move('mystyle/produk/', $fileName);
            }


            $tentangKami->update('1', [
                "nama_usaha"   => $this->request->getPost('nama_usaha'),
                "deskripsi"    => $this->request->getPost('deskripsi'),
                "alamat_usaha" => $this->request->getPost('alamat_usaha'),
                "no_tlpn"      => $this->request->getPost('phone_usaha'),
                "foto"         => $fileName,
            ]);

            //flash message
            session()->setFlashdata('message', 'berhasil diedit.');

            return redirect('admin/tentang-kami', $data);
        } else {
            return redirect('admin/tentang-kami', $data);
        }
    }
}
