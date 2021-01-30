<?php if(!isset($_SESSION)){session_start();}
    require_once('controller/script.php');
    if(!isset($_SESSION['id-user'])){$_SESSION['v']=3;}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once('application/akses/header.php')?>
        <title>Penjualan | Airku</title>
    </head>
    <body id="page-top">

        <!-- navigasi bar -->
        <?php require_once('application/templates/navbar.php');?>
        <!-- tutup navigasi bar -->

        <div class="container-fluid">
            <main>

                <!-- sambutan -->
                <div class="sambutan">
                    <h1>Selamat datang kembali <?= $_SESSION['nama-user']?></h1>
                    <?php if(isset($_SESSION['pesan-penjualan'])){?>
                        <form action="" method="POST">
                            <div class="cards-container" style="margin: 0;padding: 0;margin-top: -20px;margin-bottom: -10px;">
                                <div class="pesan-sukses">
                                    <p><?= $_SESSION['pesan-penjualan'];?></p>
                                </div>
                                <button type="submit" name="dispose-penjualan" class="btn-dispose">X</button>
                            </div>
                        </form>
                    <?php }?>
                    <?php if(isset($_SESSION['pesan-penjualan-salah'])){?>
                        <form action="" method="POST">
                            <div class="cards-container" style="margin: 0;padding: 0;margin-top: -20px;margin-bottom: -10px;">
                                <div class="pesan-gagal">
                                    <p><?= $_SESSION['pesan-penjualan-salah'];?></p>
                                </div>
                                <button type="submit" name="dispose-penjualan-salah" class="btn-dispose">X</button>
                            </div>
                        </form>
                    <?php }?>
                </div>
                <!-- tutup sambutan -->

                <!-- card -->
                <div class="cards-container">
                    <div class="card-data">
                        <h5>Masukan penjualan</h5>
                        <div class="card-data-container" style="margin-bottom: 45px; margin-top: -10px">
                            <form action="" method="POST">
                                <button type="submit" name="masukan-penjualan">View</button>
                            </form>
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <div class="card-data">
                        <h5>Data penjualan</h5>
                        <div class="card-data-container" style="margin-bottom: 15px">
                            <div class="jumlah-data"><?= $counts_penjualan?></div>
                            <i class="fas fa-table"></i>
                        </div>
                        <form action="" method="POST">
                            <button type="submit" name="data-penjualan">View</button>
                        </form>
                    </div>
                </div>
                <!-- tutup card -->

                <!-- masukan penjualan -->
                <?php if(isset($_POST['masukan-penjualan'])){?>
                <article id="masukan-penjualan">
                    <h4>Masukan penjualan</h4>
                    <form action="" method="POST">
                        <div class="form-group-pd f-edit">
                            <label>Produk</label>
                            <select name="id-produk" required>
                                <option>Pilih Produk</option>
                                <?php foreach($produk as $row):?>
                                <option value="<?= $row['id_produk']?>"><?= $row['nama_produk']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group-pd f-edit">
                            <label>Harga (per kg)</label>
                            <input type="number" name="harga" required>
                        </div>
                        <div class="form-group-pd f-edit">
                            <button type="submit" name="input-penjualan">Masukan Data</button>
                        </div>
                    </form>
                </article>
                <?php }?>
                <!-- tutup masukan penjualan -->

                <!-- data penjualan -->
                <?php if(isset($_POST['data-penjualan'])){?>
                <article id="data-penjualan">
                    <h4>Data penjualan</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Tgl Jual</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; if(mysqli_num_rows($penjualan)==0){?>
                            <tr>
                                <th colspan="10">Belum ada data yang dapat dilampirkan.</th>
                            </tr>
                            <?php }else if(mysqli_num_rows($penjualan)>0){while($row=mysqli_fetch_assoc($penjualan)){?>
                            <tr>
                                <th><?= $no?></th>
                                <td><?= $row['nama_produk']?></td>
                                <td><?= $row['stok']?></td>
                                <td>Rp. <?= number_format($row['harga'])?></td>
                                <td><?= $row['tgl_jual']?></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id-penjualan" value="<?= $row['id_penjualan']?>">
                                    <button type="submit" name="edit-penjualan" class="btn-warning"><i class="fas fa-pen"></i> Ubah</button>
                                </form></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id-penjualan" value="<?= $row['id_penjualan']?>">
                                    <button type="submit" name="hapus-penjualan" class="btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form></td>
                            </tr>
                            <?php $no++;}}?>
                        </tbody>
                    </table>
                </article>
                <?php }if(isset($_POST['edit-penjualan'])){?>
                <article id="masukan-penjualan">
                    <h4>Edit penjualan</h4>
                    <?php foreach($view_penjualan as $row):?>
                    <form action="" method="POST">
                        <div class="form-group-pd f-edit">
                            <label>Harga (per kg)</label>
                            <input type="number" name="harga" value="<?= $row['harga']?>" required>
                        </div>
                        <div class="form-group-pd f-edit">
                            <input type="hidden" name="id-penjualan" value="<?= $row['id_penjualan']?>">
                            <button type="submit" name="ubah-penjualan">Ubah Data</button>
                        </div>
                    </form>
                    <?php endforeach;?>
                </article>
                <?php }?>
                <!-- tutup data penjualan -->

            </main>
        </div>

        <!-- footer -->
        <?php require_once('application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>