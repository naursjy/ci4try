<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
    protected $table = 'komik';
    protected $useTimestamp = true;
    protected $allowedFields = ['judul', 'slugh', 'penulis', 'penerbit', 'sampul'];
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getKomik($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slugh' => $slug])->first();
    }
}
