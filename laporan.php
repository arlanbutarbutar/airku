<?php if(!isset($_SESSION)){session_start();}
    require_once('controller/script.php');
    if(!isset($_SESSION['id-user'])){$_SESSION['v']=3;}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once('application/akses/header.php')?>
        <title>Laporan | Airku</title>
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
                    <?php if(isset($_SESSION['pesan-laporan'])){?>
                        <form action="" method="POST">
                            <div class="cards-container" style="margin: 0;padding: 0;margin-top: -20px;margin-bottom: -10px;">
                                <div class="pesan-sukses">
                                    <p><?= $_SESSION['pesan-laporan'];?></p>
                                </div>
                                <button type="submit" name="dispose-laporan" class="btn-dispose">X</button>
                            </div>
                        </form>
                    <?php }?>
                </div>
                <!-- tutup sambutan -->

                <!-- card -->
                <div class="cards-container">
                    <div class="card-data">
                        <h5>Kasir</h5>
                        <div class="card-data-container" style="margin-bottom: 15px">
                            <div class="jumlah-data"><?= $counts_checkout?></div>
                            <i class="fas fa-cash-register"></i>
                        </div>
                        <form action="" method="POST">
                            <button type="submit" name="checkout">View</button>
                        </form>
                    </div>
                    <div class="card-data">
                        <h5>Laporan</h5>
                        <div class="card-data-container" style="margin-bottom: 15px">
                            <div class="jumlah-data"><?= $counts_laporan?></div>
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <form action="" method="POST">
                            <button type="submit" name="laporan">View</button>
                        </form>
                    </div>
                </div>
                <!-- tutup card -->

                <!-- data checkout -->
                <?php if(isset($_POST['checkout'])){?>
                <article id="data-checkout">
                    <h4>Data Kasir</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>No Telepon</th>
                                <th>Tgl Beli/Tgl Bayar</th>
                                <th>Jumlah Beli</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; if(mysqli_num_rows($checkout)==0){?>
                            <tr>
                                <th colspan="10">Belum ada data yang dapat dilampirkan.</th>
                            </tr>
                            <?php }else if(mysqli_num_rows($checkout)>0){while($row=mysqli_fetch_assoc($checkout)){?>
                            <tr>
                                <th><?= $no?></th>
                                <td><?= $row['nama_user']?></td>
                                <td><?= $row['no_hp']?></td>
                                <td><?= $row['tgl_keranjang']?>/<?= $row['tgl_out']?></td>
                                <td><?= $row['jumlah_beli']?></td>
                                <td>Rp. <?= number_format($row['bayar'])?></td>
                                <td><?= $row['status']?></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id-checkout" value="<?= $row['id_checkout']?>">
                                    <button type="submit" name="edit-checkout" class="btn-warning"><i class="fas fa-pen"></i> Ubah</button>
                                </form></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id-keranjang" value="<?= $row['id_keranjang']?>">
                                    <input type="hidden" name="id-checkout" value="<?= $row['id_checkout']?>">
                                    <input type="hidden" name="id-produk" value="<?= $row['id_produk']?>">
                                    <input type="hidden" name="id-pembeli" value="<?= $row['id_pembeli']?>">
                                    <input type="hidden" name="jumlah-beli" value="<?= $row['jumlah_beli']?>">
                                    <input type="hidden" name="total-beli" value="<?= $row['bayar']?>">
                                    <button type="submit" name="input-laporan" class="btn-success"><i class="fas fa-check-double"></i> Laporan</button>
                                </form></td>
                            </tr>
                            <?php $no++;}}?>
                        </tbody>
                    </table>
                </article>
                <?php }if(isset($_POST['edit-checkout'])){?>
                <article id="masukan-checkout">
                    <h4>Edit checkout</h4>
                    <?php foreach($view_checkout as $row):?>
                    <form action="" method="POST">
                        <div class="form-group-pd f-edit">
                            <label>Status</label>
                            <select name="id-status">
                                <option>Pilih Status</option>
                                <?php foreach($status_penjualan as $row1):?>
                                <option value="<?= $row1['id_status']?>"><?= $row1['status']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group-pd f-edit">
                            <input type="hidden" name="id-checkout" value="<?= $row['id_checkout']?>">
                            <button type="submit" name="ubah-checkout">Ubah Data</button>
                        </div>
                    </form>
                    <?php endforeach;?>
                </article>
                <?php }?>
                <!-- tutup data checkout -->

                <!-- data laporan -->
                <?php if(isset($_POST['laporan'])){?>
                <article id="data-laporan">
                    <h4>Data Laporan</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>No Telepon</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Beli</th>
                                <th>Total</th>
                                <th>Tgl Laporan</th>
                                <th colspan="1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; if(mysqli_num_rows($laporan)==0){?>
                            <tr>
                                <th colspan="10">Belum ada data yang dapat dilampirkan.</th>
                            </tr>
                            <?php }else if(mysqli_num_rows($laporan)>0){while($row=mysqli_fetch_assoc($laporan)){?>
                            <tr>
                                <th><?= $no?></th>
                                <td><?= $row['nama_user']?></td>
                                <td><?= $row['no_hp']?></td>
                                <td><?= $row['nama_produk']?></td>
                                <td><?= $row['jumlah_beli']?></td>
                                <td>Rp. <?= number_format($row['total_beli'])?></td>
                                <td><?= $row['tgl_laporan']?></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id-laporan" value="<?= $row['id_laporan']?>">
                                    <button type="submit" name="hapus-laporan" class="btn-danger"><i class="fas fa-trash"></i> hapus</button>
                                </form></td>
                            </tr>
                            <?php $no++;}}?>
                        </tbody>
                    </table>
                </article>
                <?php }?>
                <!-- tutup data laporan -->
            
            </main>
        </div>

        <!-- footer -->
        <?php require_once('application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>