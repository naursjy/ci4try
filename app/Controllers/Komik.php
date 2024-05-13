<?php

namespace App\Controllers;

use App\Models\KomikModel;
use ReturnTypeWillChange;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }
    public function index()
    {
        // $komik = $this->komikModel->findAll();
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];

        // cara konekdatabsetanpa model
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM komik");
        // foreach ($komik->getResult() as $row) {
        //     d($row);
        // }

        // menggunakan model
        // $komikModel = new \App\Models\KomikModel();
        // menggunakan use diatasnya untuk lebih simple


        return view('komik/index', $data);
    }
    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        // jika komik tidak ada di tabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik ' . $slug . ' Tidak ditemukan');
        }

        return view('komik/detail', $data);
    }
    public function create()
    {
        // session();
        $data = [
            'title' => 'Menambahkan Komik',

            // jika tidak bisa muncul validasi
            // 

            // coba pake ini
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ];
        return view('komik/create', $data);
    }
    public function save()
    {
        // $_REQUEST == service('request');
        // dd($this->request->getVar());

        //validasi input
        if (!$this->validate([
            // 'judul' => 'required|is_unique[komik.judul]'
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jgp,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'pilih gambar sampul dulu.',
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'ini bukan gambar',
                    'mime_in' => 'gambar tidak didukung'
                ]
            ]
        ])) {

            // jika tidak bisa muncul validasi
            //$validation = \Config\Services::validation();
            //return redirect()->to('/komik/create')->withInput();
            // ->with('validation', $validation);

            // coba pake ini
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/komik/create')->withInput();
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slugh' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        session()->setFlashdata('pesan', 'data berhasil ditambahkan');

        return redirect()->to(base_url() . '/komik');
        // echo redirect()->to(base_url().'/komik');
    }

    public function delete($id)
    {
        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus ya!!');
        return redirect()->to('/komik');
    }

    public function update($id)
    {
        $komiklama = $this->komikModel->getKomik($this->request->getVar('slugh'));
        if ($komiklama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        if (!$this->validate([
            // 'judul' => 'required|is_unique[komik.judul]'
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ]
        ])) {

            // jika tidak bisa muncul validasi
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);

            // coba pake ini
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/komik/edit/' . $this->request->getVar('slugh'))->withInput();
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slugh' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Ubah');

        return redirect()->to(base_url() . '/komik');
    }

    public function edit($slugh)
    {

        $data = [
            'title' => 'Edit Data Komik',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slugh)
        ];
        return view('komik/edit', $data);
    }
}
