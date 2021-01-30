<?php if(!isset($_SESSION)){session_start();}
    require_once('controller/script.php');
    if(isset($_SESSION['id-user']) || isset($_SESSION['id-role'])){if($_SESSION['id-role']==1){header("Location: dashboard");exit;}}else if(!isset($_SESSION['id-user'])){header("Location: auth/masuk");exit;}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once('application/akses/header.php')?>
        <title>Produk | Airku</title>
    </head>
    <body id="page-top">

        <!-- navigasi bar -->
        <?php require_once('application/templates/navbar.php');?>
        <!-- tutup navigasi bar -->

        <div class="container-fluid">
            <main>

                <?php if(isset($_SESSION['id-user']) || isset($_SESSION['id-role'])){if($_SESSION['id-role']==2){?>
                    <!-- sambutan -->
                    <div class="sambutan">
                        <h1>Selamat datang kembali <?= $_SESSION['nama-user']?></h1>
                        <?php if(isset($_SESSION['pesan-produk'])){?>
                            <form action="" method="POST">
                                <div class="cards-container" style="margin: 0;padding: 0;margin-top: -20px;margin-bottom: -10px;">
                                    <div class="pesan-sukses">
                                        <p><?= $_SESSION['pesan-produk'];?></p>
                                    </div>
                                    <button type="submit" name="dispose-produk" class="btn-dispose">X</button>
                                </div>
                            </form>
                        <?php }?>
                    </div>
                    <!-- tutup sambutan -->

                    <!-- card -->
                    <div class="cards-container">
                        <div class="card-data">
                            <h5>Masukan produk</h5>
                            <div class="card-data-container" style="margin-bottom: 45px; margin-top: -10px">
                                <form action="" method="POST">
                                    <button type="submit" name="masukan-produk">View</button>
                                </form>
                                <i class="fas fa-edit"></i>
                            </div>
                        </div>
                        <div class="card-data">
                            <h5>Data produk</h5>
                            <div class="card-data-container" style="margin-bottom: 15px">
                                <div class="jumlah-data"><?= $counts_produk?></div>
                                <i class="fas fa-boxes"></i>
                            </div>
                            <form action="" method="POST">
                                <button type="submit" name="data-produk">View</button>
                            </form>
                        </div>
                    </div>
                    <!-- tutup card -->

                    <!-- masukan produk -->
                    <?php if(isset($_POST['masukan-produk'])){?>
                    <article id="masukan-produk">
                        <h4>Masukan produk</h4>
                        <form action="" method="POST">
                            <div class="form-group-pd f-edit">
                                <label>Produk</label>
                                <input type="text" name="nama-produk" required>
                            </div>
                            <div class="form-group-pd f-edit">
                                <label>Keterangan Produk</label>
                                <textarea name="ket-produk" cols="30" rows="5" required></textarea>
                            </div>
                            <div class="form-group-pd f-edit">
                                <label>Kategori</label>
                                <select name="id-kategori" required>
                                    <option>Pilih Kategori</option>
                                    <?php foreach($kategori as $row):?>
                                    <option value="<?= $row['id_kategori']?>"><?= $row['nama_kategori']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group-pd f-edit">
                                <label>Stok (per kg)</label>
                                <input type="number" name="stok" required>
                            </div>
                            <div class="form-group-pd f-edit">
                                <button type="submit" name="input-produk">Masukan Data</button>
                            </div>
                        </form>
                    </article>
                    <?php }?>
                    <!-- tutup masukan produk -->

                    <!-- data produk -->
                    <div class="cards-container">
                        <?php if(isset($_POST['data-produk'])){?>
                        <article id="data-produk">
                            <h4>Data produk</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama produk</th>
                                        <th>Ket produk</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Tgl masuk</th>
                                        <th colspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; if(mysqli_num_rows($produk_pangan)==0){?>
                                    <tr>
                                        <th colspan="10">Belum ada data yang dapat dilampirkan.</th>
                                    </tr>
                                    <?php }else if(mysqli_num_rows($produk_pangan)>0){while($row=mysqli_fetch_assoc($produk_pangan)){?>
                                    <tr>
                                        <th><?= $no?></th>
                                        <td><?= $row['nama_produk']?></td>
                                        <td><?= $row['ket_produk']?></td>
                                        <td><?= $row['nama_kategori']?></td>
                                        <td><?= $row['stok']?></td>
                                        <td><?= $row['tgl_masuk']?></td>
                                        <td><form action="" method="POST">
                                            <input type="hidden" name="id-produk" value="<?= $row['id_produk']?>">
                                            <button type="submit" name="edit-produk" class="btn-warning"><i class="fas fa-pen"></i> Ubah</button>
                                        </form></td>
                                        <td><form action="" method="POST">
                                            <input type="hidden" name="id-produk" value="<?= $row['id_produk']?>">
                                            <button type="submit" name="hapus-produk" class="btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                        </form></td>
                                    </tr>
                                    <?php $no++;}}?>
                                </tbody>
                            </table>
                        </article>
                        <?php }if(isset($_POST['edit-produk'])){?>
                        <article id="masukan-produk">
                            <h4>Edit produk</h4>
                            <?php foreach($view_produk_pangan as $row):?>
                            <form action="" method="POST">
                                <div class="form-group-pd f-edit">
                                    <label>Produk</label>
                                    <input type="text" name="nama-produk" value="<?= $row['nama_produk']?>" required>
                                </div>
                                <div class="form-group-pd f-edit">
                                    <label>Keterangan Produk</label>
                                    <textarea name="ket-produk" cols="30" rows="5" required><?= $row['ket_produk']?></textarea>
                                </div>
                                <div class="form-group-pd f-edit">
                                    <label>Kategori</label>
                                    <select name="id-kategori" required>
                                        <option>Pilih Kategori</option>
                                        <?php foreach($kategori as $row1):?>
                                        <option value="<?= $row1['id_kategori']?>"><?= $row1['nama_kategori']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group-pd f-edit">
                                    <label>Stok (per kg)</label>
                                    <input type="number" name="stok" value="<?= $row['stok']?>" required>
                                </div>
                                <div class="form-group-pd f-edit">
                                    <input type="hidden" name="id-produk" value="<?= $row['id_produk']?>">
                                    <button type="submit" name="ubah-produk">Ubah Data</button>
                                </div>
                            </form>
                            <?php endforeach;?>
                        </article>
                        <?php }?>
                    </div>
                    <!-- tutup data produk -->
                <?php }else if($_SESSION['id-role']==3){?>
                    <div class="cards-container">
                        <div class="cards" style="width: 100%">
                            <?php if(mysqli_num_rows($penjualan)==0){?>
                            <p>Belum ada data yang dapat dilampirkan.</p>
                            <?php }else if(mysqli_num_rows($penjualan)>0){while($row=mysqli_fetch_assoc($penjualan)){?>
                            <div class="card card1">
                                <div class="card-container">
                                    <img src="assets/img/produk/<?= $row['img']?>" alt="">
                                </div>
                                <div class="details">
                                    <h3><?= $row['nama_produk']?></h3>
                                    <p><?= $row['ket_produk']?></p>
                                    <p>Stok <?= number_format($row['stok'])?> Kg</p>
                                </div>
                                <div class="pembelian">
                                    <div class="d-flex">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id-penjualan" value="<?= $row['id_penjualan']?>">
                                            <button type="submit" name="beli-produk" class="btn-success">Beli</button>
                                        </form>
                                        <p>Rp. <?= number_format($row['harga'])?>/Kg</p>
                                    </div>
                                </div>
                            </div>
                            <?php }}?>
                        </div>
                    </div>
                <?php }}?>

            </main>
        </div>

        <!-- footer -->
        <?php require_once('application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>