<?php if(!isset($_SESSION)){session_start();}
    require_once('controller/script.php');
    if(isset($_SESSION['id-user']) || isset($_SESSION['id-role'])){if($_SESSION['id-role']==1){header("Location: dashboard");exit;}else if($_SESSION['id-role']==2){header("Location: ./");exit;}}else if(!isset($_SESSION['id-user'])){header("Location: auth/masuk");exit;}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once('application/akses/header.php')?>
        <title>Kasir | Airku</title>
    </head>
    <body id="page-top">

        <!-- navigasi bar -->
        <?php require_once('application/templates/navbar.php');?>
        <!-- tutup navigasi bar -->

        <div class="container-fluid">
            <main>
                <article id="data-checkout">
                    <h4>Data pembelian anda</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penjual</th>
                                <th>No Telepon</th>
                                <th>Tgl Beli/Tgl Bayar</th>
                                <th>Jumlah Beli</th>
                                <th>Total</th>
                                <th>Status</th>
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
                            </tr>
                            <?php $no++;}}?>
                        </tbody>
                    </table>
                </article>
            </main>
        </div>

        <!-- footer -->
        <?php require_once('application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>