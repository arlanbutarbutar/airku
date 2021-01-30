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
        <title>Masuk | Airku</title>
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
                    <a href="#masuk">Masuk sekarang</a>
                </div>
                <div class="videoBox">
                    <iframe width="100%" height="400" src="https://www.youtube.com/embed/nCwTdXchhT4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <!-- tutup landing page -->

        <div class="container-fluid">
            <main>
                <!-- masuk -->
                <article id="masuk">
                    <h4>Masuk</h4>
                    <p>Belum punya akun? silakan <a href="daftar">daftar</a> dulu ya!</p>
                    <?php if(isset($_SESSION['pesan-masuk'])){?>
                    <form action="" method="POST">
                        <div class="cards-container" style="width: 350px;margin: auto;margin-top: -25px;margin-bottom: -20px;text-align: center;align-items: center;">
                            <div class="pesan-gagal">
                                <p><?= $_SESSION['pesan-masuk'];?></p>
                            </div>
                            <button type="submit" name="dispose-auth-masuk" class="btn-dispose">X</button>
                        </div>
                    </form>
                    <?php }?>
                    <div class="form-auth">
                        <form action="" method="POST">
                            <div class="form-group-pd">
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group-pd">
                                <input type="password" name="password" placeholder="Kata Sandi" required>
                            </div>
                            <div class="form-group-pd">
                                <button type="submit" name="masuk">Masuk</button>
                            </div>
                        </form>
                    </div>
                </article>
                <!-- tutup masuk -->
            </main>
        </div>

        <!-- footer -->
        <?php require_once('../application/akses/footer.php')?>
        <!-- tutup footer -->

    </body>
</html>