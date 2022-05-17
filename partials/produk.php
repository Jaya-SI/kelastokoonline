<div class="container fluid" style="margin-top: 70px;">
    <div class="container">
        <h3 class="text-center">My Product</h3>
        <div class="row my-3">
            <?php foreach ($produk as $row) : ?>
                <div class="col-md-3">
                    <!-- membuat card produk -->
                    <div class="card p-2 my-3 shadow-sm" style="width: 16rem;">
                        <img src="produk/img/<?= $row['img']; ?>" class="card-img-top" alt="..." style="max-height: 190px;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama']; ?></h5>
                            <p class="card-text"><?= $row['kategori']; ?></p>
                            <a href="#" class="btn btn-primary">Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></a>
                            <a href="beli.php?id=<?= $row['id_produk']; ?>" class="btn btn-success">Beli</a>
                        </div>
                    </div>
                    <!-- akhir membuat card produk -->
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>