<?php if(!isset($_SESSION)){session_start();}
    require_once('connect.php');require_once('functions.php');
    if(isset($_POST['dispose-kontak'])){unset($_SESSION['pesan-kontak']);
        if(isset($_SESSION['id-role'])){if($_SESSION['id-role']==1){header("Location: dashboard");exit;}}else{header("Location: ./#kontak");exit;}
    }
    if(isset($_POST['dispose-daftar'])){unset($_SESSION['pesan-daftar']);header("Location: ./#produk");exit;}
    if(isset($_POST['dispose-jadwal'])){unset($_SESSION['pesan-jadwal']);header("Location: jadwal");exit;}
    if(isset($_POST['dispose-catatan'])){unset($_SESSION['pesan-catatan']);header("Location: catatan");exit;}
    if(isset($_POST['dispose-produk'])){unset($_SESSION['pesan-produk']);header("Location: produk");exit;}
    if(isset($_POST['dispose-penjualan'])){unset($_SESSION['pesan-penjualan']);header("Location: penjualan");exit;}
    if(isset($_POST['dispose-dashboard'])){unset($_SESSION['pesan-dashboard']);header("Location: dashboard");exit;}
    if(isset($_POST['dispose-laporan'])){unset($_SESSION['pesan-laporan']);header("Location: laporan");exit;}
    if(isset($_POST['dispose-penjualan-salah'])){unset($_SESSION['pesan-penjualan-salah']);header("Location: penjualan");exit;}
    if(isset($_POST['dispose-auth-daftar'])){unset($_SESSION['pesan-daftar']);header("Location: daftar#daftar");exit;}
    if(isset($_POST['dispose-auth-masuk'])){unset($_SESSION['pesan-masuk']);header("Location: masuk#masuk");exit;}
    if(isset($_SESSION['v'])){
        $kategori=mysqli_query($conn, "SELECT * FROM kategori");
        $liat_produk_pangan=mysqli_query($conn, "SELECT * FROM produk_pangan ORDER BY id_kategori ASC LIMIT 3");
        if(isset($_POST['liat-kategori'])){
            $id_kategori=addslashes(trim($_POST['id-kategori']));
            $liat_produk_pangan=mysqli_query($conn, "SELECT * FROM produk_pangan WHERE id_kategori='$id_kategori' ORDER BY id_kategori ASC LIMIT 3");
            header('Location: index');exit;
        }
        if(isset($_POST['kontak'])){
            if(kontak($_POST)>0){
                $_SESSION['pesan-kontak']="Terima kasih telah mengirimkan pesan, akan segera kami balas secepatnya!";
                header("Location: ./#kontak");exit;
            }
        }
        if(isset($_POST['daftar'])){
            if(daftar($_POST)>0){
                header("Location: auth/masuk");exit;
            }
        }
    }if(isset($_SESSION['auth'])){
        if(isset($_POST['daftar'])){
            if(daftar($_POST)>0){
                header("Location: masuk");exit;
            }
        }
        if(isset($_POST['masuk'])){
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['email']))));
            $password=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['password']))));
            $users=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($users)>0){
                $row=mysqli_fetch_assoc($users);
                $pass=$row['password'];
                if(password_verify($password, $pass)){
                    if(isset($_SESSION['v'])){
                        unset($_SESSION['v']);
                    }if(isset($_SESSION['auth'])){
                        unset($_SESSION['auth']);
                    }
                    $_SESSION['id-user']=$row['id_user'];
                    $_SESSION['nama-user']=$row['nama_user'];
                    $_SESSION['id-role']=$row['id_role'];
                    if($_SESSION['id-role']==1){
                        header("Location: ../dashboard");exit;
                    }else if($_SESSION['id-role']>1){
                        header("Location: ../");exit;
                    }
                }else{
                    $_SESSION['pesan-masuk']="Maaf, kata sandi yang anda masukan salah.";
                    header("Location: masuk#masuk");return false;
                }
            }else if(mysqli_num_rows($users)==0){
                $_SESSION['pesan-masuk']="Maaf, akun anda belum terdaftar.";
                header("Location: masuk#masuk");return false;
            }
        }
    }if(isset($_SESSION['id-user'])){if(isset($_SESSION['id-role'])){
        $id_user=addslashes(trim($_SESSION['id-user']));
        if($_SESSION['id-role']==1){
            $count_users=mysqli_query($conn, "SELECT * FROM users WHERE id_role>1");
            $counts_user=mysqli_num_rows($count_users);
            $users=mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_role>1");
            if(isset($_POST['edit-users'])){
                $id_user=addslashes(trim($_POST['id-user']));
                $view_users=mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user='$id_user'");
            }
            $users_role=mysqli_query($conn, "SELECT * FROM users_role");
            if(isset($_POST['ubah-user'])){
                if(users_ubah($_POST)>0){
                    $_SESSION['pesan-users']="Data user berhasil diubah.";
                    header("Location: dashboard");exit;
                }
            }
            if(isset($_POST['hapus-user'])){
                if(users_hapus($_POST)>0){
                    $_SESSION['pesan-dashboard']="Data user berhasil dihapus.";
                    header("Location: dashboard");exit;
                }
            }
            $count_produk=mysqli_query($conn, "SELECT * FROM produk_pangan");
            $counts_produk=mysqli_num_rows($count_produk);
            $produk=mysqli_query($conn, "SELECT * FROM produk_pangan JOIN users ON produk_pangan.id_user=users.id_user JOIN kategori ON produk_pangan.id_kategori=kategori.id_kategori");
            if(isset($_POST['hapus-produk'])){
                if(produk_hapus($_POST)>0){
                    $_SESSION['pesan-dashboard']="Data berhasil dihapus";
                    header("Location: dashboard");exit;
                }
            }
            $count_penjualan=mysqli_query($conn, "SELECT * FROM penjualan");
            $counts_penjualan=mysqli_num_rows($count_penjualan);
            $penjualan=mysqli_query($conn, "SELECT * FROM penjualan JOIN produk_pangan ON penjualan.id_produk=produk_pangan.id_produk JOIN kategori ON produk_pangan.id_kategori=kategori.id_kategori JOIN users ON produk_pangan.id_user=users.id_user");
            if(isset($_POST['hapus-penjualan'])){
                if(penjualan_hapus($_POST)>0){
                    $_SESSION['pesan-dashboard']="Data berhasil dihapus";
                    header("Location: dashboard");exit;
                }
            }
            $count_kontak=mysqli_query($conn, "SELECT * FROM kontak");
            $counts_kontak=mysqli_num_rows($count_kontak);
            $kontak=mysqli_query($conn, "SELECT * FROM kontak");
            if(isset($_POST['hapus-kontak'])){
                if(hapus_kontak($_POST)>0){
                    $_SESSION['pesan-dashboard']="Pesan yang anda pilih berhasil dihapus.";
                    header("Location: dashboard");exit;
                }
            }
        }else if($_SESSION['id-role']==2){
            $jadwal_petani=mysqli_query($conn, "SELECT * FROM jadwal_petani WHERE id_user='$id_user'");
            if(isset($_POST['input-jadwal'])){
                if(jadwal_baru($_POST)>0){
                    $_SESSION['pesan-jadwal']="Data berhasil di tambahkan!";
                    header("Location: jadwal");exit;
                }
            }
            if(isset($_POST['hapus-jadwal'])){
                if(jadwal_hapus($_POST)>0){
                    $_SESSION['pesan-jadwal']="Data berhasil dihapus!";
                    header("Location: jadwal");exit;
                }
            }
            $count_catatan=mysqli_query($conn, "SELECT * FROM catatan_petani WHERE id_user='$id_user'");
            $counts_catatan=mysqli_num_rows($count_catatan);
            $catatan_petani=mysqli_query($conn, "SELECT * FROM catatan_petani WHERE id_user='$id_user'");
            $view_catatan_petani=mysqli_query($conn, "SELECT * FROM catatan_petani WHERE id_user='$id_user'");
            if(isset($_POST['input-catatan'])){
                if(catatan_baru($_POST)>0){
                    $_SESSION['pesan-catatan']="Data berhasil di tambahkan!";
                    header("Location: catatan");exit;
                }
            }
            if(isset($_POST['ubah-catatan'])){
                if(catatan_ubah($_POST)>0){
                    $_SESSION['pesan-catatan']="Data berhasil diubah!";
                    header("Location: catatan");exit;
                }
            }
            if(isset($_POST['hapus-catatan'])){
                if(catatan_hapus($_POST)>0){
                    $_SESSION['pesan-catatan']="Data berhasil dihapus!";
                    header("Location: catatan");exit;
                }
            }
            $count_produk=mysqli_query($conn, "SELECT * FROM produk_pangan WHERE id_user='$id_user'");
            $counts_produk=mysqli_num_rows($count_produk);
            $kategori=mysqli_query($conn, "SELECT * FROM kategori");
            $produk_pangan=mysqli_query($conn, "SELECT * FROM produk_pangan JOIN kategori ON produk_pangan.id_kategori=kategori.id_kategori WHERE produk_pangan.id_user='$id_user'");
            if(isset($_POST['input-produk'])){
                if(produk_baru($_POST)>0){
                    $_SESSION['pesan-produk']="Data berhasil dimasukan.";
                    header("Location: produk");exit;
                }
            }
            if(isset($_POST['edit-produk'])){
                $id_produk=addslashes(trim($_POST['id-produk']));
                $view_produk_pangan=mysqli_query($conn, "SELECT * FROM produk_pangan WHERE produk_pangan.id_produk='$id_produk'");
            }
            if(isset($_POST['ubah-produk'])){
                if(produk_ubah($_POST)>0){
                    $_SESSION['pesan-produk']="Data berhasil diubah";
                    header("Location: produk");exit;
                }
            }
            if(isset($_POST['hapus-produk'])){
                if(produk_hapus($_POST)>0){
                    $_SESSION['pesan-produk']="Data berhasil dihapus";
                    header("Location: produk");exit;
                }
            }
            $count_penjualan=mysqli_query($conn, "SELECT * FROM penjualan WHERE id_user='$id_user'");
            $counts_penjualan=mysqli_num_rows($count_penjualan);
            $produk=mysqli_query($conn, "SELECT * FROM produk_pangan JOIN kategori ON produk_pangan.id_kategori=kategori.id_kategori WHERE produk_pangan.id_user='$id_user'");
            if(isset($_POST['input-penjualan'])){
                if(penjualan_baru($_POST)>0){
                    $_SESSION['pesan-penjualan']="Data berhasil ditambahkan.";
                    header("Location: penjualan");exit;
                }
            }
            $penjualan=mysqli_query($conn, "SELECT * FROM penjualan JOIN produk_pangan ON penjualan.id_produk=produk_pangan.id_produk WHERE penjualan.id_user='$id_user'");
            if(isset($_POST['edit-penjualan'])){
                $id_penjualan=addslashes(trim($_POST['id-penjualan']));
                $view_penjualan=mysqli_query($conn, "SELECT id_penjualan,harga FROM penjualan WHERE id_penjualan='$id_penjualan'");
            }
            if(isset($_POST['ubah-penjualan'])){
                if(penjualan_ubah($_POST)>0){
                    $_SESSION['pesan-penjualan']="Data berhasil diubah.";
                    header("Location: penjualan");exit;
                }
            }
            if(isset($_POST['hapus-penjualan'])){
                if(penjualan_hapus($_POST)>0){
                    $_SESSION['pesan-penjualan']="Data berhasil dihapus.";
                    header("Location: penjualan");exit;
                }
            }
            $count_checkout=mysqli_query($conn, "SELECT * FROM checkout WHERE id_user='$id_user'");
            $counts_checkout=mysqli_num_rows($count_checkout);
            $checkout=mysqli_query($conn, "SELECT * FROM checkout 
                JOIN keranjang ON checkout.id_keranjang=keranjang.id_keranjang 
                JOIN penjualan ON keranjang.id_penjualan=penjualan.id_penjualan
                JOIN produk_pangan ON penjualan.id_produk=produk_pangan.id_produk
                JOIN users ON checkout.id_pembeli=users.id_user 
                JOIN status_penjualan ON checkout.id_status=status_penjualan.id_status 
                WHERE checkout.id_user='$id_user'
            ");
            if(isset($_POST['edit-checkout'])){
                $id_checkout=addslashes(trim($_POST['id-checkout']));
                $view_checkout=mysqli_query($conn, "SELECT * FROM checkout WHERE id_checkout='$id_checkout'");
            }
            $status_penjualan=mysqli_query($conn, "SELECT * FROM status_penjualan WHERE id_status>2");
            if(isset($_POST['ubah-checkout'])){
                if(checkout_ubah($_POST)>0){
                    $_SESSION['pesan-laporan']="Data berhasil diubah.";
                    header("Location: laporan");exit;
                }
            }
            if(isset($_POST['input-laporan'])){
                if(laporan_baru($_POST)>0){
                    $_SESSION['pesan-laporan']="Data berhasil dimasukan sebagai laporan pembelian.";
                    header("Location: laporan");exit;
                }
            }
            $count_laporan=mysqli_query($conn, "SELECT * FROM laporan WHERE id_user='$id_user'");
            $counts_laporan=mysqli_num_rows($count_laporan);
            $laporan=mysqli_query($conn, "SELECT * FROM laporan 
                JOIN produk_pangan ON laporan.id_produk=produk_pangan.id_produk
                JOIN users ON laporan.id_pembeli=users.id_user 
                WHERE laporan.id_user='$id_user'
            ");
            if(isset($_POST['hapus-laporan'])){
                if(laporan_hapus($_POST)>0){
                    $_SESSION['pesan-laporan']="Data berhasil dihapus.";
                    header("Location: laporan");exit;
                }
            }
        }else if($_SESSION['id-role']==3){
            $penjualan=mysqli_query($conn, "SELECT * FROM penjualan JOIN produk_pangan ON penjualan.id_produk=produk_pangan.id_produk");
            if(isset($_POST['beli-produk'])){
                if(keranjang_baru($_POST)>0){
                    header("Location: keranjang");exit;
                }
            }
            $count_checkout=mysqli_query($conn, "SELECT * FROM checkout WHERE id_pembeli='$id_user'");
            $counts_checkout=mysqli_num_rows($count_checkout);
            $count_keranjang=mysqli_query($conn, "SELECT * FROM keranjang WHERE id_pembeli='$id_user'");
            $counts_keranjang=mysqli_num_rows($count_keranjang);
            $keranjang=mysqli_query($conn, "SELECT * FROM keranjang 
                JOIN penjualan ON keranjang.id_penjualan=penjualan.id_penjualan 
                JOIN produk_pangan ON penjualan.id_produk=produk_pangan.id_produk 
                WHERE keranjang.id_pembeli='$id_user'
            ");
            if(isset($_POST['ubah-keranjang'])){
                if(keranjang_ubah($_POST)>0){
                    header("Location: keranjang");exit;
                }
            }
            if(isset($_POST['checkout'])){
                if(keranjangToCheckout($_POST)>0){
                    header("Location: kasir");exit;
                }
            }
            if(isset($_POST['hapus-keranjang'])){
                if(keranjang_hapus($_POST)>0){
                    header("Location: produk");exit;
                }
            }
            $checkout=mysqli_query($conn, "SELECT * FROM checkout 
                JOIN keranjang ON checkout.id_keranjang=keranjang.id_keranjang 
                JOIN penjualan ON keranjang.id_penjualan=penjualan.id_penjualan
                JOIN produk_pangan ON penjualan.id_produk=produk_pangan.id_produk
                JOIN users ON checkout.id_user=users.id_user 
                JOIN status_penjualan ON checkout.id_status=status_penjualan.id_status 
                WHERE checkout.id_pembeli='$id_user'
            ");
        }
    }}