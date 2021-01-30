<?php if(!isset($_SESSION)){session_start();}
    require_once('controller/script.php');
    if(!isset($_SESSION['id-user']) || !isset($_SESSION['id-role'])){header("Location: auth/masuk");exit;}
    if(isset($_SESSION['id-role'])){if($_SESSION['id-role']>1){header("Location: ./");exit;}}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once('application/akses/header.php')?>
        <title>Dashboard | Airku</title>
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
                    <?php if(isset($_SESSION['pesan-dashboard'])){?>
                        <form action="" method="POST">
                            <div class="cards-container" style="margin: 0;padding: 0;margin-top: -20px;margin-bottom: -10px;">
                                <div class="pesan-sukses">
                                    <p><?= $_SESSION['pesan-dashboard'];?></p>
                                </div>
                                <button type="submit" name="dispose-dashboard" class="btn-dispose">X</button>
                            </div>
                        </form>
                    <?php }?>
                </div>
                <!-- tutup sambutan -->

                <!-- card -->
                <div class="cards-container">
                    <div class="card-data">
                        <h5>Users</h5>
                        <div class="card-data-container">
                            <div class="jumlah-data"><?= $counts_user?></div>
                            <i class="fas fa-user"></i>
                        </div>
                        <form action="" method="POST">
                            <button type="submit" name="users">View</button>
                        </form>
                    </div>
                    <div class="card-data">
                        <h5>Produk</h5>
                        <div class="card-data-container">
                            <div class="jumlah-data"><?= $counts_produk?></div>
                            <i class="fas fa-boxes"></i>
                        </div>
                        <form action="" method="POST">
                            <button type="submit" name="produk">View</button>
                        </form>
                    </div>
                    <div class="card-data">
                        <h5>Penjualan</h5>
                        <div class="card-data-container">
                            <div class="jumlah-data"><?= $counts_penjualan?></div>
                            <i class="fas fa-store"></i>
                        </div>
                        <form action="" method="POST">
                            <button type="submit" name="penjualan">View</button>
                        </form>
                    </div>
                    <div class="card-data">
                        <h5>Kontak</h5>
                        <div class="card-data-container">
                            <div class="jumlah-data"><?= $counts_kontak?></div>
                            <i class="fas fa-headset"></i>
                        </div>
                        <form action="" method="POST">
                            <button type="submit" name="kontak">View</button>
                        </form>
                    </div>
                </div>
                <!-- tutup card -->

                <!-- users -->
                <?php if(isset($_POST['users'])){?>
                <article id="users">
                    <h4>Users</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No. Handphone</th>
                                <th>Tgl Buat</th>
                                <th>Status</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; if(mysqli_num_rows($users)==0){?>
                            <tr>
                                <th colspan="10">Belum ada data yang dapat dilampirkan.</th>
                            </tr>
                            <?php }else if(mysqli_num_rows($users)>0){while($row=mysqli_fetch_assoc($users)){?>
                            <tr>
                                <th><?= $no?></th>
                                <td><img src="assets/img/<?= $row['img']?>" alt="" style="width: 50px;"></td>
                                <td><?= $row['nama_user']?></td>
                                <td><?= $row['email']?></td>
                                <td><?= $row['alamat']?></td>
                                <td><?= $row['no_hp']?></td>
                                <td><?= $row['tgl_buat']?></td>
                                <td><?= $row['role']?></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                    <button type="submit" name="edit-users" class="btn-warning"><i class="fas fa-pen"></i> Ubah</button>
                                </form></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                    <button type="submit" name="hapus-user" class="btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form></td>
                            </tr>
                            <?php $no++;}}?>
                        </tbody>
                    </table>
                </article>
                <?php }if(isset($_POST['edit-users'])){?>
                <article id="masukan-users">
                    <h4>Edit User</h4>
                    <?php foreach($view_users as $row):?>
                    <form action="" method="POST">
                        <div class="form-group-pd f-edit">
                            <label>Role</label>
                            <select name="id-role" required>
                                <option>Pilih Role</option>
                                <?php foreach($users_role as $row1):?>
                                <option value="<?= $row1['id_role']?>"><?= $row1['role']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group-pd f-edit">
                            <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                            <button type="submit" name="ubah-user">Ubah Data</button>
                        </div>
                    </form>
                    <?php endforeach;?>
                </article>
                <?php }?>
                <!-- tutup users -->

                <!-- produk -->
                <?php if(isset($_POST['produk'])){?>
                <article id="produk-admin">
                    <h4>produk</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penjual</th>
                                <th>Email</th>
                                <th>Nama Produk</th>
                                <th>Keterangan</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Tgl Masuk</th>
                                <th colspan="1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; if(mysqli_num_rows($produk)==0){?>
                            <tr>
                                <th colspan="9">Belum ada data yang dapat dilampirkan.</th>
                            </tr>
                            <?php }else if(mysqli_num_rows($produk)>0){while($row=mysqli_fetch_assoc($produk)){?>
                            <tr>
                                <th><?= $no?></th>
                                <td><?= $row['nama_user']?></td>
                                <td><?= $row['email']?></td>
                                <td><?= $row['nama_produk']?></td>
                                <td><?= $row['ket_produk']?></td>
                                <td><?= $row['nama_kategori']?></td>
                                <td><?= $row['stok']?></td>
                                <td><?= $row['tgl_masuk']?></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id-produk" value="<?= $row['id_produk']?>">
                                    <button type="submit" name="hapus-produk" class="btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form></td>
                            </tr>
                            <?php $no++;}}?>
                        </tbody>
                    </table>
                </article>
                <?php }?>
                <!-- tutup produk -->

                <!-- penjualan -->
                <?php if(isset($_POST['penjualan'])){?>
                <article id="penjualan">
                    <h4>penjualan</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penjual</th>
                                <th>Email</th>
                                <th>Nama Produk</th>
                                <th>Keterangan</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Tgl Jual</th>
                                <th colspan="1">Aksi</th>
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
                                <td><?= $row['nama_user']?></td>
                                <td><?= $row['email']?></td>
                                <td><?= $row['nama_produk']?></td>
                                <td><?= $row['ket_produk']?></td>
                                <td><?= $row['nama_kategori']?></td>
                                <td><?= $row['stok']?></td>
                                <td><?= $row['harga']?></td>
                                <td><?= $row['tgl_buat']?></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id-penjualan" value="<?= $row['id_penjualan']?>">
                                    <button type="submit" name="hapus-penjualan" class="btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form></td>
                            </tr>
                            <?php $no++;}}?>
                        </tbody>
                    </table>
                </article>
                <?php }?>
                <!-- tutup penjualan -->

                <!-- kontak -->
                <?php if(isset($_POST['kontak'])){?>
                <article id="kontak-admin">
                    <h4>kontak</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th colspan="1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; if(mysqli_num_rows($kontak)==0){?>
                            <tr>
                                <th colspan="10">Belum ada data yang dapat dilampirkan.</th>
                            </tr>
                            <?php }else if(mysqli_num_rows($kontak)>0){while($row=mysqli_fetch_assoc($kontak)){?>
                            <tr>
                                <th><?= $no?></th>
                                <td><?= $row['nama']?></td>
                                <td><?= $row['email']?></td>
                                <td><?= $row['pesan']?></td>
                                <td><form action="" method="POST">
                                    <input type="hidden" name="id_kontak" value="<?= $row['id_kontak']?>">
                                    <button type="submit" name="hapus-kontak" class="btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form></td>
                            </tr>
                            <?php $no++;}}?>
                        </tbody>
                    </table>
                </article>
                <?php }?>
                <!-- tutup kontak -->

            </main>
        </div>

        <!-- footer -->
        <?php require_once('application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>