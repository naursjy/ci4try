<?= $this->extend('layout/tamplet'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/komik/create" class="btn btn-primary mt-3">Add Komik</a>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <h1>Daftar Komik</h1>
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($komik as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $k['sampul']; ?>" alt="" class="sampul"></td>
                            <td><?= $k['judul']; ?></td>
                            <td><a href="/komik/<?= $k['slugh']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?= $this->endsection(); ?>