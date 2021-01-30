<?php if(!isset($_SESSION)){session_start();}
    require_once('controller/script.php');
    if(!isset($_SESSION['id-user'])){$_SESSION['v']=3;}else if(isset($_SESSION['id-user']) || isset($_SESSION['id-role'])){if($_SESSION['id-role']==1){header("Location: dashboard");exit;}}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once('application/akses/header.php')?>
        <title>Airku</title>
    </head>
    <body id="page-top">

        <!-- navigasi bar -->
        <?php require_once('application/templates/navbar.php');?>
        <!-- tutup navigasi bar -->

        <!-- landing page -->
        <div class="container">
            <div class="banner">
                <div class="textBox">
                    <h2>Pangan Indonesia</h2>
                    <p>System irigasi, pemasaran dan distribusi bahan mentah bagi para petani indonesia dalam mengelola hasil panennya.</p>
                    <a href="#tentang">Liat Lebih</a>
                </div>
                <div class="videoBox">
                    <iframe width="100%" height="400" src="https://www.youtube.com/embed/nCwTdXchhT4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <!-- tutup landing page -->

        <div class="container-fluid">
            <main>
                <!-- tentang -->
                <article id="tentang">
                    <h4>Tentang</h4>
                    <div class="bg-tentang">
                        <img src="assets/img/water.png" alt="Icon">
                    </div>
                    <div class="tentang-box">
                        <div class="textBox1">
                            <p>Dalam memenuhi kebutuhan air khususnya untuk kebutuhan air di persawahan maka perlu didirikan sistem irigasi dan bangunan bendung. Kebutuhan air di persawahan ini kemudian disebut dengan kebutuhan air irigasi. Untuk irigasi, pengertiannya adalah usaha penyediaan, pengaturan dan pembuangan air irigasi untuk menunjang pertanian yang jenisnya meliputi irigasi permukaan, irigasi rawa, irigasi air bawah tanah, irigasi pompa, dan irigasi tambak. Tujuan irigasi adalah untuk memanfaatkan air irigasi yang tersedia secara benar yakni seefisien dan seefektif mungkin agar produktivitas pertanian dapat meningkat sesuai yang diharapkan.</p>
                        </div>
                        <div class="textBox2">
                            <p>Air irigasi di Indonesia umumnya bersumber dari sungai, waduk, air tanah dan sistem pasang surut. Salah satu usaha peningkatan produksi pangan khususnya padi adalah tersedianya air irigasi di sawah* sawah sesuai dengan kebutuhan. Kebutuhan air yang diperlukan pada areal irigasi besarnya bervariasi sesuai keadaan. Kebutuhan air irigasi adalah jumlah volume air yang diperlukan untuk memenuhi kebutuhan evaporasi,kehilangan air, kebutuhan air untuk tanaman dengan memperhatikan jumlah air yang diberikan oleh alam melalui hujan dan kontribusi air tanah.</p>
                        </div>
                    </div>
                </article>
                <!-- tutup tentang -->

                <!-- produk -->
                <?php if(isset($_SESSION['v'])){?>
                <article id="produk">
                    <h4>Produk</h4>
                    <div class="box-kg">
                        <form action="" method="POST">
                            <?php foreach($kategori as $row):?>
                            <input type="hidden" name="id-kategori" value="<?= $row['id_kategori']?>">
                            <button type="submit" name="liat-kategori" class="btn-kg"><?= $row['nama_kategori']?></button>
                            <?php endforeach;?>
                        </form>
                    </div>
                    <div class="cards-container">
                        <div class="cards">
    
                            <div class="card card1">
                                <div class="card-container">
                                    <img src="assets/img/produk/padi.jpg" alt="">
                                </div>
                                <div class="details">
                                    <h3>Padi</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>
    
                            <div class="card card2">
                                <div class="card-container">
                                    <img src="assets/img/produk/jagung.jpg" alt="">
                                </div>
                                <div class="details">
                                    <h3>Jagung</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>
    
                            <div class="card card3">
                                <div class="card-container">
                                    <img src="assets/img/produk/sayuran.jpg" alt="">
                                </div>
                                <div class="details">
                                    <h3>Tebu</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>
    
                        </div>
                        <div class="form-daftar">
                            <h3>Daftar</h3>
                            <p>Sudah punya akun? silakan <a href="auth/masuk">masuk.</a></p>
                            <?php if(isset($_SESSION['pesan-daftar'])){?>
                            <form action="" method="POST">
                                <div class="cards-container" style="margin: 0;padding: 0;margin-top: -20px;margin-bottom: -10px;">
                                    <div class="pesan-gagal">
                                        <p><?= $_SESSION['pesan-daftar'];?></p>
                                    </div>
                                    <button type="submit" name="dispose-daftar" class="btn-dispose">X</button>
                                </div>
                            </form>
                            <?php }?>
                            <form action="" method="POST">
                                <div class="form-group-pd">
                                    <input type="text" name="nama" placeholder="Nama" required autocomplete="on">
                                </div>
                                <div class="form-group-pd">
                                    <input type="email" name="email" placeholder="Email" required autocomplete="on">
                                </div>
                                <div class="form-group-pd">
                                    <input type="text" name="alamat" placeholder="Alamat" required autocomplete="on">
                                </div>
                                <div class="form-group-pd">
                                    <input type="number" name="no-hp" placeholder="Nomor Telepon" required autocomplete="on">
                                </div>
                                <div class="form-group-pd">
                                    <input type="password" name="password" placeholder="Kata Sandi" required autocomplete="on">
                                </div>
                                <div class="form-group-pd">
                                    <button type="submit" name="daftar">Daftar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </article>
                <?php }?>
                <!-- tutup produk -->
                
                <!-- solusi -->
                <article id="solusi" <?php if(isset($_SESSION['id-user'])){?>style="margin-top: -55px"<?php }?>>
                    <h4>Solusi</h4>
                    <div class="cards-container">
                        <div class="card-sl">
                            <div class="card-sl-image">
                                <img src="assets/img/card-1.jpg" alt="">
                            </div>
                            <div class="card-sl-text">
                                <p>Mengatur jadwal panen yang benar dan sesuai.</p>
                            </div>
                        </div>
                        <div class="card-sl">
                            <div class="card-sl-image">
                                <img src="assets/img/card-2.jpg" alt="">
                            </div>
                            <div class="card-sl-text">
                                <p>Menjadwal masa panen dan pengairan yang teratur.</p>
                            </div>
                        </div>
                        <div class="card-sl">
                            <div class="card-sl-image">
                                <img src="assets/img/card-3.jpg" alt="">
                            </div>
                            <div class="card-sl-text">
                                <p>Dapat memudahkan proses distribusi atau penjualan kepada konsumen.</p>
                            </div>
                        </div>
                        <div class="card-sl">
                            <div class="card-sl-image">
                                <img src="assets/img/card-4.jpg" alt="">
                            </div>
                            <div class="card-sl-text">
                                <p>Memberikan transparansi kepada penjual dan komsumen pada produk pangan yang berkualitas tinggi.</p>
                            </div>
                        </div>
                    </div>
                </article>
                <!-- tutup solusi -->
                
                <!-- kontak -->
                <article id="kontak">
                    <h4>Kontak</h4>
                    <div class="cards-container">
                        <div class="kontak-b-1">
                            <p>Silakan hubungi kami jika anda mengalami masalah!</p>
                            <?php if(isset($_SESSION['pesan-kontak'])){?>
                            <form action="" method="POST">
                                <div class="cards-container">
                                    <div class="pesan-sukses">
                                        <p><?= $_SESSION['pesan-kontak'];?></p>
                                    </div>
                                    <button type="submit" name="dispose-kontak" class="btn-dispose">X</button>
                                </div>
                            </form>
                            <?php }?>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <input type="text" name="nama" placeholder="Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="pesan" cols="30" rows="5" placeholder="Pesan" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="kontak" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                        <div class="kontak-b-2">
                            <img src="assets/img/2457533.png" alt="Gambar Kontak">
                        </div>
                    </div>
                </article>
                <!-- tutup kontak -->
            </main>
        </div>

        <!-- footer -->
        <?php require_once('application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>