<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Controllers\BaseController;
use App\Models\Konfirmasi_pembayaran;
use CodeIgniter\Exceptions\PageNotFoundException;

class User extends BaseController
{
    protected $db, $builder;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }

    public function index()
    {
        if (logged_in() == 1) {

            $this->builder->select('users.id as userid,username,email,name,created_at');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->where('auth_groups_users.user_id', user()->id);
            $query = $this->builder->get();
            $data['users'] = $query->getRow();

            if ($data['users']->name == 'user') {

                $data['title'] = 'Dashboard';
                $builder = $this->db->table('tb_barang');
                $query   = $builder->get();

                $data['barang'] = $query->getResult();

                return view('users/index', $data);
            } elseif ($data['users']->name == 'admin') {
                $data['title'] = 'Dashboard';

                $builder = $this->db->table('tb_barang');
                $builder->selectCount('kd_barang');
                $query = $builder->get();
                $data['total_produk'] = $query->getRow();

                $builder = $this->db->table('tb_transaksi');
                $builder->selectSum('total_harga');
                $builder->where("status_transaksi = 'PROSES KIRIM' OR status_transaksi = 'DONE'");
                $query = $builder->get();
                $data['total_penjualan'] = $query->getRow();

                $builder = $this->db->table('tb_transaksi');
                $builder->selectCount('total_harga');
                $builder->where("status_transaksi <> 'PROSES KIRIM'");
                $query = $builder->get();
                $data['pending_payment'] = $query->getRow();

                $builder = $this->db->table('tb_transaksi');
                $builder->selectCount('total_harga');
                $builder->where("status_transaksi = 'DONE'");
                $query = $builder->get();
                $data['success_payment'] = $query->getRow();

                return view('admin/index', $data);
            } else {
                return view('/');
            }
        } elseif (logged_in() == 0) {

            $data['title'] = 'Home';
            $builder = $this->db->table('tb_barang');
            $query   = $builder->get();

            $data['barang'] = $query->getResult();

            return view('users/index', $data);
        } else {
            echo "tidak ditemukan apapun";
        }
    }

    public function masukan_keranjang($id = 0)
    {
        $data['title'] = 'Masukan keranjang';


        $keranjang = new Keranjang;

        // VALIDASI 
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_barang' => 'required',
            'total_barang' => 'required',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // END VALIDASI

        // GET PRODUK DATA 
        $builder = $this->db->table('tb_barang');
        $builder->where('kd_barang', $id);
        $query   = $builder->get();
        $data['barang'] = $query->getRow();


        if ($isDataValid) {

            $totalharga = $data['barang']->harga_jual * $this->request->getPost('total_barang');

            $keranjang->insert([
                "id_barang"            => $data['barang']->kd_barang,
                "id_pembeli"           => user()->id,
                "quantity_beli"        => $this->request->getPost('total_barang'),
                "total_harga"           => $totalharga,
                "status_dikeranjang"    => 'aktif',
                "created_at"         =>  date('Y-m-d'),
                "updated_at"         =>  date('Y-m-d'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Produk berhasil dimasukan keranjang.');

            return view('produk/detail', $data);
        }

        return view('produk/detail', $data);
    }

    public function keranjang_belanja()
    {
        $data['title'] = 'Keranjang Belanja';

        $builder = $this->db->table('tb_keranjang');
        $builder->join('tb_barang', 'tb_barang.kd_barang = tb_keranjang.id_barang');
        $builder->where('id_pembeli', user()->id);
        $builder->where('status_dikeranjang =', 'aktif');
        $query = $builder->get();

        $data['keranjang'] = $query->getResult();

        // var_dump(  $data['keranjang']);
        // die;

        $builder = $this->db->table('tb_keranjang');
        $builder->selectSum('total_harga');
        $builder->where('id_pembeli', user()->id);
        $builder->where('status_dikeranjang =', 'aktif');
        $query = $builder->get();
        $data['subtotal_price'] = $query->getRow();

        return view('keranjang/index', $data);
    }

    public function keranjang_edit_quantity($id = 0)
    {
        $data['title'] = 'Keranjang edit';

        $keranjang = new Keranjang();
        $builder = $this->db->table('tb_keranjang');
        $builder->join('tb_barang', 'tb_barang.kd_barang = tb_keranjang.id_barang');
        $builder->where('id', $id);
        $query = $builder->get();
        $data['keranjang'] = $query->getRow();

        // VALIDASI 
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'quantity_beli' => 'required',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // END VALIDASI

        if ($isDataValid) {

            $totalharga = $this->request->getPost('quantity_beli') * $data['keranjang']->harga_jual;

            $keranjang->update($id, [
                "quantity_beli"     => $this->request->getPost('quantity_beli'),
                "total_harga"       => $totalharga,
                "updated_at"        => date('Y-m-d H:i:s')
            ]);

            //flash message
            session()->setFlashdata('message', 'Jumlah produk Berhasil diedit.');

            $data['title'] = 'Keranjang Belanja';

            $builder = $this->db->table('tb_keranjang');
            $builder->join('tb_barang', 'tb_barang.kd_barang = tb_keranjang.id_barang');
            $builder->where('id_pembeli', user()->id);
            $query = $builder->get();

            $data['keranjang'] = $query->getResult();

            // var_dump(  $data['keranjang']);
            // die;

            $builder = $this->db->table('tb_keranjang');
            $builder->selectSum('total_harga');
            $builder->where('id_pembeli', user()->id);
            $query = $builder->get();
            $data['subtotal_price'] = $query->getRow();

            return redirect('keranjang', $data);
        }

        return redirect('keranjang', $data);
    }

    public function keranjang_delete($id)
    {
        $keranjang = new Keranjang();
        $keranjang->delete($id);
        //flash message
        session()->setFlashdata('message', 'Produk Berhasil dihapus dari keranjang.');

        return redirect('keranjang');
    }

    public function proses_checkout()
    {

        $data['title'] = 'Proses checkout';
        $transaksi     = new Transaksi;
        $keranjang     = new Keranjang;
        $pembeli       = new Pembeli;

        // VALIDASI 
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama'   => 'required',
            'telp'   => 'required',
            'alamat' => 'required',
            'image'  => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,4096]',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // END VALIDASI

        // GET PRODUK DATA 
        $builder = $this->db->table('tb_keranjang');
        $builder->where('id_pembeli',  user()->id);
        $builder->where('status_dikeranjang =', 'aktif');
        $query             = $builder->get();
        $data['keranjang'] = $query->getResult();

        $generate_kd_pesanan = strtoupper(chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999));

        if ($isDataValid) {

            $image = $this->request->getFile('image');
            $fileName = time() . $image->getClientName();

            $image->move('mystyle/bukti_pembayaran/', $fileName);

            // cek data pembeli jika ada

            $pembeli->insert([
                'id_pembeli'   => user()->id,
                'kd_pesanan'   => $generate_kd_pesanan,
                'nama_pembeli' => $this->request->getPost('nama'),
                'telp'         => $this->request->getPost('telp'),
                'alamat'       => $this->request->getPost('alamat')
            ]);

            foreach ($query->getResult() as $data) {
                $transaksi->insert([
                    "kd_pesanan"            => $generate_kd_pesanan,
                    "id_pembeli"            => user()->id,
                    "jml_barang"            => $data->quantity_beli,
                    "kd_barang"             => $data->id_barang,
                    "total_harga"           => $data->total_harga,
                    "bukti_pembayaran"      => $fileName,
                    "status_transaksi"      => 'MENUNGGU KONFIRMASI',
                    "tgl_transaksi"         =>  date('Y-m-d'),
                ]);

                $keranjang->update($data->id, [
                    "status_dikeranjang"    => "DONE",
                ]);
            }

            //flash message
            session()->setFlashdata('message', 'Produk berhasil diproses, silakan cek detail pesanan pada halaman orders"');

            return redirect('keranjang', $data);
        }

        return redirect('keranjang', $data);
    }

    public function orders_index()
    {
        $data['title'] = 'Orders';

        $builder = $this->db->table('tb_transaksi');
        $builder->selectSum('tb_transaksi.jml_barang');
        $builder->selectSum('tb_transaksi.total_harga');
        $builder->join('tb_pembeli', 'tb_pembeli.kd_pesanan = tb_transaksi.kd_pesanan');
        $builder->select('tb_transaksi.kd_pesanan,nama_pembeli,telp,alamat,bukti_pembayaran,status_transaksi,tanggal_kirim,tanggal_sampai');
        $builder->where('tb_transaksi.id_pembeli', user()->id);
        $builder->groupBy('tb_transaksi.kd_pesanan');
        $builder->orderBy('tb_transaksi.id', 'DESC');
        $query   = $builder->get();
        $data['orders'] = $query->getResult();

        return view('orders/index', $data);
    }

    public function invoice($kd_pesanan = 0)
    {
        $data['title'] = 'Invoice';
        $data['kd_pesanan'] = $kd_pesanan;
        $builder = $this->db->table('tb_transaksi');
        $builder->join('tb_pembeli', 'tb_pembeli.kd_pesanan = tb_transaksi.kd_pesanan');
        $builder->join('tb_barang', 'tb_barang.kd_barang = tb_transaksi.kd_barang');
        $builder->select('tb_transaksi.kd_pesanan,nama_pembeli,telp,alamat,bukti_pembayaran,status_transaksi,tanggal_kirim,tanggal_sampai, nama_barang,harga_jual,jml_barang,total_harga');
        $builder->where('tb_transaksi.kd_pesanan', $kd_pesanan);
        $builder->orderBy('tb_transaksi.id', 'DESC');
        $query          = $builder->get();
        $data['orders'] = $query->getResult();

        if (in_groups('admin')) {
            $builder = $this->db->table('tb_pembeli');
            $builder->where('kd_pesanan',  $kd_pesanan);
            $user         = $builder->get();
        } else {
            $builder = $this->db->table('tb_pembeli');
            $builder->where('id_pembeli',  user()->id);
            $builder->where('kd_pesanan',  $kd_pesanan);
            $user         = $builder->get();
        }
        $data['user'] = $user->getRow();

        return view('orders/invoice', $data);
    }

    public function detail_produk($kd_barang = 0)
    {
        $data['title'] = 'Detail Produk';
        $builder = $this->db->table('tb_barang');
        $builder->where('kd_barang', $kd_barang);
        $query   = $builder->get();
        $data['barang'] = $query->getRow();

        if (empty($data['barang'])) {
            return redirect()->to('/');
        }

        return view('produk/detail', $data);
    }

    public function data_pembeli()
    {
        $data['title'] = 'Data pembeli';

        // $builder = $this->db->table('tb_transaksi');
        // $builder->join('tb_barang','tb_barang.kd_barang = tb_transaksi.kd_barang');
        // $builder->where('id_pembeli', user()->id);   
        // $query = $builder->get();

        // $data['orders'] = $query->getResult();

        return view('data_pembeli/index', $data);
    }

    public function tentang_kami()
    {
        $data['title'] = 'Tentang Kami';

        $builder = $this->db->table('tb_tentang_kami');
        $query   = $builder->get();
        $data['tentang'] = $query->getRow();

        return view('tentang-kami', $data);
    }
}