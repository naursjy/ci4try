<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        return view('/pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us'
        ];
        return view('/pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'rumah',
                    'alamat' => 'jl.ABC',
                    'kota' => 'Kudus'
                ],
                [
                    'tipe' => 'kantor',
                    'alamat' => 'jl.Setia Abadi',
                    'kota' => 'Jepara'
                ]
            ]
        ];
        return view('/pages/contact', $data);
    }
}
