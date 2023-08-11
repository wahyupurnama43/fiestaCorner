<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\BaseController;
use Myth\Auth\Password;

class Home extends BaseController
{
    protected $db, $builder;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }


    public function index()
    {
        $data['title'] = ' HOME PAGE';
        return view('welcome_message', $data);
    }


    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function user()
    {
        return view('users/index');
    }

    public function lupapass()
    {
        return view('auth/lupa-pass');
    }

    function sendMail($to)
    {
        $subject = 'Reset Password';
        $message = '
        <!doctype html>
        <html lang="en-US">
        
        <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <title>Reset Password Email Template</title>
            <meta name="description" content="Reset Password Email Template.">
            <style type="text/css">
                a:hover {text-decoration: underline !important;}
            </style>
        </head>
        
        <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
            <!--100% body table-->
            <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                <tr>
                    <td>
                        <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                            align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="height:80px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                        style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0 35px;">
                                                <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:Rubik,sans-serif;">Rubah Password Kamu</h1>
                                                <span
                                                    style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                                <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                    Kamu klik tombol di bawah ini untuk merubah password kamu
                                                </p>
                                                <a href="' . base_url('/reset-password') . '/' . $to . '"
                                                    style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                                    Password</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="height:80px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--/100% body table-->
        </body>
        
        </html>';

        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('wahyupurnama434@gmail.com', 'Confirm Registration');

        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) {
            return true;
        } else {
            var_dump('gaga');
            die;
        }
    }

    public function reset_password()
    {
        $user = new User;
        // VALIDASI 
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'email'   => 'required',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // END VALIDASI
        $to = $this->request->getPost('email');


        if ($isDataValid) {

            $data = [
                'reset_hash' => md5('resetpass' . $to),
            ];

            $builder = $this->db->table('users');
            $builder->where('email', $to);
            $builder->update($data);

            $this->sendMail($to);
            session()->setFlashdata('message', 'Berhasil Mengirimkan Email');

            return redirect('login');
        }
    }



    public function password_reset($email)
    {
        $builder = $this->db->table('users');
        $builder->where('email', $email);
        $query = $builder->get();
        $user  = $query->getRow();
        if ($user->reset_hash == md5('resetpass' . $email)) {

            if ($this->request->getPost('password')) {

                // VALIDASI 
                $validation =  \Config\Services::validation();
                $validation->setRules([
                    'password'   => 'required',
                ]);
                $isDataValid = $validation->withRequest($this->request)->run();
                // END VALIDASI
                $password = (string)$this->request->getPost('password');
                $passwordKonfirm = $this->request->getPost('passwordKonfirm');
                if ($isDataValid) {

                    $data = [
                        'reset_hash'    => null,
                        'password_hash' => Password::hash($password),
                    ];

                    $builder = $this->db->table('users');
                    $builder->where('email', $email);
                    $builder->update($data);

                    session()->setFlashdata('message', 'Berhasil Mengirimkan Email');

                    return redirect('login');
                }
            } else {
                $data['email'] = $email;
                return view('auth/new-pass', $data);
            }
        } else {
            session()->setFlashdata('error', 'Tidak Mendapatkan Aksess');

            return redirect('login');
        }
    }
}