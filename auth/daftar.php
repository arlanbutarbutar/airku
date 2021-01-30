<?php if(!isset($_SESSION)){session_start();}
    require_once('../controller/script.php');
    $_SESSION['auth']=4;
    if(isset($_SESSION['v'])){unset($_SESSION['v']);}
    if(isset($_SESSION['id-user']) || isset($_SESSION['id-role'])){header("Location: ../");exit;}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once('../application/akses/header.php')?>
        <title>Daftar | Airku</title>
    </head>
    <body id="page-top">

        <!-- navigasi bar -->
        <?php require_once('../application/templates/navbar.php');?>
        <!-- tutup navigasi bar -->
        
        <!-- landing page -->
        <div class="container">
            <div class="banner">
                <div class="textBox">
                    <h2>Pangan Indonesia</h2>
                    <p>System irigasi, pemasaran dan distribusi bahan mentah bagi para petani indonesia dalam mengelola hasil panennya.</p>
                    <a href="#daftar">Daftar</a>
                </div>
                <div class="videoBox">
                    <iframe width="100%" height="400" src="https://www.youtube.com/embed/nCwTdXchhT4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <!-- tutup landing page -->

        <div class="container-fluid">
            <main>
                <!-- daftar -->
                <article id="daftar">
                    <h4>Daftar</h4>
                    <p>Sudah punya akun? silakan <a href="masuk">masuk</a>!</p>
                    <?php if(isset($_SESSION['pesan-daftar'])){?>
                    <form action="" method="POST">
                        <div class="cards-container" style="margin: 0;padding: 0;margin-top: -20px;margin-bottom: -10px;">
                            <div class="pesan-gagal">
                                <p><?= $_SESSION['pesan-daftar'];?></p>
                            </div>
                            <button type="submit" name="dispose-auth-daftar" class="btn-dispose">X</button>
                        </div>
                    </form>
                    <?php }?>
                    <div class="form-auth">
                        <form action="" method="POST">
                            <div class="form-group-pd">
                                <input type="text" name="nama" placeholder="Nama Kamu" required>
                            </div>
                            <div class="form-group-pd">
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group-pd">
                                <input type="text" name="alamat" placeholder="Alamat" required>
                            </div>
                            <div class="form-group-pd">
                                <input type="number" name="no-hp" placeholder="No Telepon/HP" required>
                            </div>
                            <div class="form-group-pd">
                                <input type="password" name="password" placeholder="Kata Sandi" required>
                            </div>
                            <div class="form-group-pd">
                                <button type="submit" name="daftar">Daftar</button>
                            </div>
                        </form>
                    </div>
                </article>
                <!-- tutup daftar -->
            </main>
        </div>

        <!-- footer -->
        <?php require_once('../application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>