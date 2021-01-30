<?php if(!isset($_SESSION)){session_start();}
    require_once('controller/script.php');
    if(isset($_SESSION['id-user']) || isset($_SESSION['id-role'])){if($_SESSION['id-role']==1){header("Location: dashboard");exit;}else if($_SESSION['id-role']==3){header("Location: ./");exit;}}else if(!isset($_SESSION['id-user'])){header("Location: auth/masuk");exit;}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once('application/akses/header.php')?>
        <title>Jadwal | Airku</title>
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
                    <?php if(isset($_SESSION['pesan-jadwal'])){?>
                        <form action="" method="POST">
                            <div class="cards-container" style="margin: 0;padding: 0;margin-top: -20px;margin-bottom: -10px;">
                                <div class="pesan-sukses">
                                    <p><?= $_SESSION['pesan-jadwal'];?></p>
                                </div>
                                <button type="submit" name="dispose-jadwal" class="btn-dispose">X</button>
                            </div>
                        </form>
                    <?php }?>
                </div>
                <!-- tutup sambutan -->


                <!-- card -->
                <div class="cards-container">
                    <div class="card-data">
                        <h5>Masukan Jadwal</h5>
                        <div class="card-data-container" style="margin-bottom: 15px">
                            <form action="" method="POST">
                                <button type="submit" name="masukan-jadwal">View</button>
                            </form>
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                    </div>
                    <div class="card-data">
                        <h5>Data Jadwal</h5>
                        <div class="card-data-container" style="margin-bottom: 15px">
                            <form action="" method="POST">
                                <button type="submit" name="data-jadwal">View</button>
                            </form>
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                <!-- tutup card -->

                <!-- masukan jadwal -->
                <?php if(isset($_POST['masukan-jadwal'])){?>
                <article id="masukan-jadwal">
                    <h4>Masukan Jadwal</h4>
                    <form action="" method="POST">
                        <div class="form-group-pd f-edit">
                            <label>Nama Jadwal</label>
                            <input type="text" name="nama-jadwal" required>
                        </div>
                        <div class="form-group-pd f-edit">
                            <label>Tgl Panen</label>
                            <input type="date" name="tgl-target" required>
                        </div>
                        <div class="form-group-pd f-edit">
                            <label>Tgl Pengairan</label>
                            <input type="date" name="tgl-pengairan" required>
                        </div>
                        <div class="form-group-pd f-edit">
                            <button type="submit" name="input-jadwal">Masukan Data</button>
                        </div>
                    </form>
                </article>
                <?php }?>
                <!-- tutup masukan jadwal -->

                <!-- data jadwal -->
                <?php if(isset($_POST['data-jadwal'])){?>
                <article id="data-jadwal">
                    <h4>Data Jadwal</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jadwal</th>
                                <th>Tgl Buat</th>
                                <th>Tgl Panen</th>
                                <th>Tgl Pengairan</th>
                                <th colspan="1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; if(mysqli_num_rows($jadwal_petani)==0){?>
                            <tr>
                                <th colspan="10">Belum ada data yang dapat dilampirkan.</th>
                            </tr>
                            <?php }else if(mysqli_num_rows($jadwal_petani)>0){while($row=mysqli_fetch_assoc($jadwal_petani)){?>
                            <tr>
                                <th><?= $no?></th>
                                <td><?= $row['nama_jadwal']?></td>
                                <td><?= $row['tgl_buat']?></td>
                                <td><?= $row['tgl_target']?></td>
                                <td><?= $row['tgl_pengairan']?></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id-jadwal" value="<?= $row['id_jadwal']?>">
                                    <button type="submit" name="hapus-jadwal" class="btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form></td>
                            </tr>
                            <?php $no++;}}?>
                        </tbody>
                    </table>
                </article>
                <?php }?>
                <!-- tutup data jadwal -->

            </main>
        </div>

        <!-- footer -->
        <?php require_once('application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>