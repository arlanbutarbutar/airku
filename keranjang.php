<?php if(!isset($_SESSION)){session_start();}
    require_once('controller/script.php');
    if(isset($_SESSION['id-user']) || isset($_SESSION['id-role'])){if($_SESSION['id-role']==1){header("Location: dashboard");exit;}else if($_SESSION['id-role']==2){header("Location: ./");exit;}}else if(!isset($_SESSION['id-user'])){header("Location: auth/masuk");exit;}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once('application/akses/header.php')?>
        <title>Keranjang | Airku</title>
    </head>
    <body id="page-top">

        <!-- navigasi bar -->
        <?php require_once('application/templates/navbar.php');?>
        <!-- tutup navigasi bar -->

        <div class="container-fluid">
            <main>
                <div class="cart-container">
                    <?php if(mysqli_num_rows($keranjang)>0){while($row=mysqli_fetch_assoc($keranjang)){?>
                    <div class="d-flex">
                        <div class="cards card-keranjang">
                            <div class="card card1">
                                <div class="card-container">
                                    <img src="assets/img/produk/<?= $row['img']?>" alt="">
                                </div>
                                <div class="details">
                                    <h3><?= $row['nama_produk']?></h3>
                                    <p><?= $row['ket_produk']?></p>
                                    <p>Stok <?= number_format($row['stok'])?> Kg</p>
                                    <p>Rp. <?= number_format($row['harga'])?>/Kg</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-checkout">
                            <?php $jumlah_beli=$row['jumlah_beli'];if($jumlah_beli==0){?>
                            <form action="" method="POST">
                                <div class="form-group-pd">
                                    <label>Berapa banyak yang ingin anda beli?</label>
                                    <input type="number" name="jumlah-beli">
                                </div>
                                <div style="text-align: center">
                                    <input type="hidden" name="id-keranjang" value="<?= $row['id_keranjang']?>">
                                    <button type="submit" name="ubah-keranjang" class="btn-success">Masukan</button>
                                    <button type="submit" name="hapus-keranjang" class="btn-danger">Batal</button>
                                </div>
                            </form>
                            <?php }else if($jumlah_beli>0){?>
                            <form action="" method="POST">
                                <input type="hidden" name="id-keranjang" value="<?= $row['id_keranjang']?>">
                                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                <input type="hidden" name="harga" value="<?= $row['harga']?>">
                                <input type="hidden" name="jumlah-beli" value="<?= $row['jumlah_beli']?>">
                                <input type="hidden" name="stok" value="<?= $row['stok']?>">
                                <input type="hidden" name="id-produk" value="<?= $row['id_produk']?>">
                                <button type="submit" name="checkout" class="btn-success">Bayar</button>
                                <?php }?>
                            </form>
                        </div>
                    </div>
                    <?php }}?>
                </div>
            </main>
        </div>

        <!-- footer -->
        <?php require_once('application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>