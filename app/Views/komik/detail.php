<?= $this->extend('layout/tamplet'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?= $komik['sampul']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Judul Komik : <?= $komik['judul']; ?></h5>
                            <p class="card-text">Nama Penulis : <?= $komik['penulis']; ?></p>
                            <p class="card-text"><small class="text-muted">Tempat Terbit : <?= $komik['penerbit']; ?></small></p>
                            <br>
                            <a href="/komik/edit/<?= $komik['slugh']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/komik/<?= $komik['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah kamu yakin dengan ini?')">Delete</button>
                            </form>
                            <!-- <a href="/komik/delete/" class="btn btn-danger">Delete</a> -->
                            <br>
                            <a href="/komik">Kembali ke Komik</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>