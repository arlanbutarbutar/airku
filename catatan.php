<?php if(!isset($_SESSION)){session_start();}
    require_once('controller/script.php');
    if(isset($_SESSION['id-user']) || isset($_SESSION['id-role'])){if($_SESSION['id-role']==1){header("Location: dashboard");exit;}else if($_SESSION['id-role']==3){header("Location: ./");exit;}}else if(!isset($_SESSION['id-user'])){header("Location: auth/masuk");exit;}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once('application/akses/header.php')?>
        <title>Catatan | Airku</title>
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
                    <?php if(isset($_SESSION['pesan-catatan'])){?>
                        <form action="" method="POST">
                            <div class="cards-container" style="margin: 0;padding: 0;margin-top: -20px;margin-bottom: -10px;">
                                <div class="pesan-sukses">
                                    <p><?= $_SESSION['pesan-catatan'];?></p>
                                </div>
                                <button type="submit" name="dispose-catatan" class="btn-dispose">X</button>
                            </div>
                        </form>
                    <?php }?>
                </div>
                <!-- tutup sambutan -->

                <!-- card -->
                <div class="cards-container">
                    <?php if($counts_catatan==0){?>
                    <div class="card-data">
                        <h5>Masukan Catatan</h5>
                        <div class="card-data-container" style="margin-bottom: 15px">
                            <form action="" method="POST">
                                <button type="submit" name="masukan-catatan">View</button>
                            </form>
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <?php }?>
                    <div class="card-data">
                        <h5>Data catatan</h5>
                        <div class="card-data-container" style="margin-bottom: 15px">
                            <form action="" method="POST">
                                <button type="submit" name="data-catatan">View</button>
                            </form>
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                </div>
                <!-- tutup card -->

                <!-- masukan catatan -->
                <?php if(isset($_POST['masukan-catatan'])){?>
                <article id="masukan-catatan">
                    <h4>Masukan catatan</h4>
                    <form action="" method="POST">
                        <div class="form-group-pd f-edit">
                            <label>Catatan</label>
                            <textarea name="catatan" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group-pd f-edit">
                            <button type="submit" name="input-catatan">Masukan Data</button>
                        </div>
                    </form>
                </article>
                <?php }?>
                <!-- tutup masukan catatan -->

                <!-- data catatan -->
                <div class="cards-container">
                    <?php if(isset($_POST['data-catatan'])){?>
                    <article id="data-catatan">
                        <h4>Data catatan</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Catatan</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; if(mysqli_num_rows($catatan_petani)==0){?>
                                <tr>
                                    <th colspan="10">Belum ada data yang dapat dilampirkan.</th>
                                </tr>
                                <?php }else if(mysqli_num_rows($catatan_petani)>0){while($row=mysqli_fetch_assoc($catatan_petani)){?>
                                <tr>
                                    <th><?= $no?></th>
                                    <td><?= $row['catatan']?></td>
                                    <td><form action="" method="POST">
                                        <button type="submit" name="edit-catatan" class="btn-warning"><i class="fas fa-pen"></i> Ubah</button>
                                    </form></td>
                                    <td><form action="" method="POST">
                                        <input type="hidden" name="id-catatan" value="<?= $row['id_catatan']?>">
                                        <button type="submit" name="hapus-catatan" class="btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                    </form></td>
                                </tr>
                                <?php $no++;}}?>
                            </tbody>
                        </table>
                    </article>
                    <?php }if(isset($_POST['edit-catatan'])){?>
                    <article id="masukan-catatan">
                        <h4>Edit Catatan</h4>
                        <?php foreach($view_catatan_petani as $row):?>
                        <form action="" method="POST">
                            <div class="form-group-pd">
                                <label>Catatan</label>
                                <textarea name="catatan" cols="30" rows="10"><?= $row['catatan']?></textarea>
                            </div>
                            <div class="form-group-pd">
                                <input type="hidden" name="id-catatan" value="<?= $row['id_catatan']?>">
                                <button type="submit" name="ubah-catatan">Ubah Data</button>
                            </div>
                        </form>
                        <?php endforeach;?>
                    </article>
                    <?php }?>
                </div>
                <!-- tutup data catatan -->

            </main>
        </div>

        <!-- footer -->
        <?php require_once('application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>