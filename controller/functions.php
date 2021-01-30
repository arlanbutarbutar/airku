<?php if(!isset($_SESSION)){session_start();}
    if(isset( $_SESSION['v']) || isset($_SESSION['auth'])){
        function kontak($add){global $conn;
            $nama=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['nama']))));
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['email']))));
            $pesan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['pesan']))));
            mysqli_query($conn, "INSERT INTO kontak(nama,email,pesan) VALUES('$nama','$email','$pesan')");
            return mysqli_affected_rows($conn);
        }
        function daftar($add){global $conn;
            $nama=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['nama']))));
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['email']))));
            $users=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($users)>0){
                $_SESSION['pesan-daftar']="Maaf, email yang kamu daftarkan sudah ada!";
                if(isset($_SESSION['auth'])){
                    header("Location: daftar#daftar");
                    return false;
                }else if(!isset($_SESSION['auth'])){
                    header("Location: ./#produk");
                    return false;
                }
            }
            $pass=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['password']))));
            $cekPass=strlen($pass);
            if($cekPass<8){
                $_SESSION['pesan-daftar']="Maaf, password kamu terlalu pendek (Min: 8)!";
                if(isset($_SESSION['auth'])){
                    header("Location: daftar#daftar");
                    return false;
                }else if(!isset($_SESSION['auth'])){
                    header("Location: ./#produk");
                    return false;
                }
            }
            $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['alamat']))));
            $no_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['no-hp']))));
            if(!is_numeric($no_hp)){
                $_SESSION['pesan-daftar']="Maaf, anda tidak memasuki nomor handphone dengan benar!";
                if(isset($_SESSION['auth'])){
                    header("Location: daftar#daftar");
                    return false;
                }else if(!isset($_SESSION['auth'])){
                    header("Location: ./#produk");
                    return false;
                }
            }
            $tgl_buat=date('Y-m-d');
            $password=password_hash($pass, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO users(nama_user,email,password,alamat,no_hp,tgl_buat) VALUES('$nama','$email','$password','$alamat','$no_hp','$tgl_buat')");
            return mysqli_affected_rows($conn);
        }
    }if(isset($_SESSION['id-user']) || isset($_SESSION['id-role'])){
        if($_SESSION['id-role']==1){
            function users_ubah($ubah){global $conn;
                $id_user=addslashes(trim($ubah['id-user']));
                $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ubah['id-role']))));
                mysqli_query($conn, "UPDATE users SET id_role='$id_role' WHERE id_user='$id_user'");
                return mysqli_affected_rows($conn);
            }
            function users_hapus($hapus){
                global $conn;
                $id_user=addslashes(trim($hapus['id-user']));
                mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
                return mysqli_affected_rows($conn);
            }
            function produk_hapus($hapus){global $conn;
                $id_produk=addslashes(trim($hapus['id-produk']));
                mysqli_query($conn, "DELETE FROM produk_pangan WHERE id_produk='$id_produk'");
                return mysqli_affected_rows($conn);
            }
            function penjualan_hapus($hapus){global $conn;
                $id_penjualan=addslashes(trim($hapus['id-penjualan']));
                mysqli_query($conn, "DELETE FROM penjualan WHERE id_penjualan='$id_penjualan'");
                return mysqli_affected_rows($conn);
            }
            function hapus_kontak($hapus){
                global $conn;
                $id_kontak=$hapus['id_kontak'];
                mysqli_query($conn, "DELETE FROM kontak WHERE id_kontak='$id_kontak'");
                return mysqli_affected_rows($conn);
            }
        }else if($_SESSION['id-role']==2){
            function jadwal_baru($add){global $conn;
                $id_user=addslashes(trim($_SESSION['id-user']));
                $nama_jadwal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['nama-jadwal']))));
                $tgl_buat=date('Y-m-d');
                $tgl_target=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['tgl-target']))));
                $tgl_pengairan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['tgl-pengairan']))));
                mysqli_query($conn, "INSERT INTO jadwal_petani(id_user,nama_jadwal,tgl_buat,tgl_target,tgl_pengairan) VALUES('$id_user','$nama_jadwal','$tgl_buat','$tgl_target','$tgl_pengairan')");
                return mysqli_affected_rows($conn);
            }
            function jadwal_hapus($hapus){global $conn;
                $id_jadwal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $hapus['id-jadwal']))));
                mysqli_query($conn, "DELETE FROM jadwal_petani WHERE id_jadwal='$id_jadwal'");
                return mysqli_affected_rows($conn);
            }
            function catatan_baru($add){global $conn;
                $id_user=addslashes(trim($_SESSION['id-user']));
                $catatan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['catatan']))));
                mysqli_query($conn, "INSERT INTO catatan_petani(id_user,catatan) VALUES('$id_user','$catatan')");
                return mysqli_affected_rows($conn);
            }
            function catatan_ubah($ubah){global $conn;
                $id_catatan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ubah['id-catatan']))));
                $catatan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ubah['catatan']))));
                mysqli_query($conn, "UPDATE catatan_petani SET catatan='$catatan' WHERE id_catatan='$id_catatan'");
                return mysqli_affected_rows($conn);
            }
            function catatan_hapus($hapus){global $conn;
                $id_catatan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $hapus['id-catatan']))));
                mysqli_query($conn, "DELETE FROM catatan_petani WHERE id_catatan='$id_catatan'");
                return mysqli_affected_rows($conn);
            }
            function produk_baru($add){global $conn;
                $id_user=addslashes(trim($_SESSION['id-user']));
                $nama_produk=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['nama-produk']))));
                $ket_produk=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['ket-produk']))));
                $id_kategori=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-kategori']))));
                if($id_kategori==1){
                    $img="padi.jpg";
                }else if($id_kategori==2){
                    $img="jagung.jpg";
                }else if($id_kategori==3){
                    $img="sayuran.jpg";
                }else if($id_kategori==4){
                    $img="buah.jpg";
                }
                $stok=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['stok']))));
                $tgl_masuk=date("Y-m-d");
                mysqli_query($conn, "INSERT INTO produk_pangan(id_user,img,nama_produk,ket_produk,id_kategori,stok,tgl_masuk) VALUES('$id_user','$img','$nama_produk','$ket_produk','$id_kategori','$stok','$tgl_masuk')");
                return mysqli_affected_rows($conn);
            }
            function produk_ubah($ubah){global $conn;
                $id_produk=addslashes(trim($ubah['id-produk']));
                $nama_produk=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ubah['nama-produk']))));
                $ket_produk=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ubah['ket-produk']))));
                $id_kategori_check=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ubah['id-kategori']))));
                $stok=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ubah['stok']))));
                if(empty($id_kategori_check)){
                    $id_kategori=$id_kategori_check;
                    mysqli_query($conn, "UPDATE produk_pangan SET nama_produk='$nama_produk', ket_produk='$ket_produk', id_kategori='$id_kategori', stok='$stok' WHERE id_produk='$id_produk'");
                }else if(!empty($id_kategori_check)){
                    mysqli_query($conn, "UPDATE produk_pangan SET nama_produk='$nama_produk', ket_produk='$ket_produk', stok='$stok' WHERE id_produk='$id_produk'");
                }
                return mysqli_affected_rows($conn);
            }
            function produk_hapus($hapus){global $conn;
                $id_produk=addslashes(trim($hapus['id-produk']));
                mysqli_query($conn, "DELETE FROM produk_pangan WHERE id_produk='$id_produk'");
                return mysqli_affected_rows($conn);
            }
            function penjualan_baru($add){global $conn;
                $id_user=addslashes(trim($_SESSION['id-user']));
                $id_produk=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-produk']))));
                $penjualan=mysqli_query($conn, "SELECT * FROM penjualan WHERE id_produk='$id_produk'");
                if(mysqli_num_rows($penjualan)>0){
                    $_SESSION['pesan-penjualan-salah']="Maaf, produk telah dimasukan ke penjualan.";
                    header("Location: penjualan");exit;
                }
                $harga=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['harga']))));
                $tgl_jual=date("Y-m-d");
                mysqli_query($conn, "INSERT INTO penjualan(id_produk,id_user,harga,tgl_jual) VALUES('$id_produk','$id_user','$harga','$tgl_jual')");
                return mysqli_affected_rows($conn);
            }
            function penjualan_ubah($ubah){global $conn;
                $id_penjualan=addslashes(trim($ubah['id-penjualan']));
                $harga=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ubah['harga']))));
                mysqli_query($conn, "UPDATE penjualan SET harga='$harga' WHERE id_penjualan='$id_penjualan'");
                return mysqli_affected_rows($conn);
            }
            function penjualan_hapus($hapus){global $conn;
                $id_penjualan=addslashes(trim($hapus['id-penjualan']));
                mysqli_query($conn, "DELETE FROM penjualan WHERE id_penjualan='$id_penjualan'");
                return mysqli_affected_rows($conn);
            }
            function checkout_ubah($ubah){global $conn;
                $id_checkout=addslashes(trim($ubah['id-checkout']));
                $id_status=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ubah['id-status']))));
                mysqli_query($conn, "UPDATE checkout SET id_status='$id_status' WHERE id_checkout='$id_checkout'");
                return mysqli_affected_rows($conn);
            }
            function laporan_baru($add){global $conn;
                $id_user=addslashes(trim($_SESSION['id-user']));
                $id_keranjang=addslashes(trim($add['id-keranjang']));
                $id_checkout=addslashes(trim($add['id-checkout']));
                $id_produk=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-produk']))));
                $id_pembeli=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-pembeli']))));
                $jumlah_beli=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['jumlah-beli']))));
                $total_beli=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['total-beli']))));
                $tgl_laporan=date("Y-m-d");
                mysqli_query($conn, "INSERT INTO laporan(id_produk,id_user,id_pembeli,jumlah_beli,total_beli,tgl_laporan) VALUES('$id_produk','$id_user','$id_pembeli','$jumlah_beli','$total_beli','$tgl_laporan')");
                mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang='$id_keranjang'");
                mysqli_query($conn, "DELETE FROM checkout WHERE id_checkout='$id_checkout'");
                return mysqli_affected_rows($conn);
            }
            function laporan_hapus($hapus){global $conn;
                $id_laporan=addslashes(trim($hapus['id-laporan']));
                mysqli_query($conn, "DELETE FROM laporan WHERE id_laporan='$id_laporan'");
                return mysqli_affected_rows($conn);
            }
        }else if($_SESSION['id-role']==3){
            function keranjang_baru($add){global $conn;
                $id_user=addslashes(trim($_SESSION['id-user']));
                $id_penjualan=addslashes(trim($add['id-penjualan']));
                $tgl_keranjang=date('Y-m-d');
                mysqli_query($conn, "INSERT INTO keranjang(id_penjualan,id_pembeli,tgl_keranjang) VALUES('$id_penjualan','$id_user','$tgl_keranjang')");
                return mysqli_affected_rows($conn);
            }
            function keranjang_ubah($ubah){global $conn;
                $id_keranjang=addslashes(trim($ubah['id-keranjang']));
                $jumlah_beli=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ubah['jumlah-beli']))));
                if(empty($jumlah_beli)){
                    $jumlah_beli=1;
                }
                mysqli_query($conn, "UPDATE keranjang SET jumlah_beli='$jumlah_beli' WHERE id_keranjang='$id_keranjang'");
                return mysqli_affected_rows($conn);
            }
            function keranjangToCheckout($add){global $conn;
                $id_keranjang=addslashes(trim($add['id-keranjang']));
                $checkout=mysqli_query($conn, "SELECT * FROM checkout WHERE id_keranjang='$id_keranjang'");
                if(mysqli_num_rows($checkout)>0){
                    header("Location: keranjang");exit;
                }
                $id_user=addslashes(trim($add['id-user']));
                $id_pembeli=addslashes(trim($_SESSION['id-user']));
                $tgl_out=date('Y-m-d');
                $harga=addslashes(trim($add['harga']));
                $jumlah_beli=addslashes(trim($add['jumlah-beli']));
                $id_produk=addslashes(trim($add['id-produk']));
                $stok=addslashes(trim($add['stok']));
                $total=$harga*$jumlah_beli;
                $stok_akhir=$stok-$jumlah_beli;
                mysqli_query($conn, "INSERT INTO checkout(id_keranjang,id_user,id_pembeli,tgl_out,bayar,id_status) VALUES('$id_keranjang','$id_user','$id_pembeli','$tgl_out','$total','1')");
                mysqli_query($conn, "UPDATE produk_pangan SET stok='$stok_akhir' WHERE id_produk='$id_produk'");
                return mysqli_affected_rows($conn);
            }
            function keranjang_hapus($hapus){global $conn;
                $id_keranjang=addslashes(trim($hapus['id-keranjang']));
                mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang='$id_keranjang'");
                return mysqli_affected_rows($conn);
            }
        }
    }
