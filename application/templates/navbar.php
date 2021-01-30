<?php if(isset($_SESSION['v']) || isset($_SESSION['auth'])){?>
    <header>
        <a href="#page-top" class="logo"><img src="<?php if(isset($_SESSION['auth'])){echo "../";}?>assets/img/water.png" alt=""></a>
        <div class="menu-toggle"><i class="fas fa-bars"></i></div>
        <nav>
            <ul>
                <li><a href="<?php if(isset($_SESSION['auth'])){echo "../";}?>./">Beranda</a></li>
                <li><a href="<?php if(isset($_SESSION['auth'])){echo "../";}?>#tentang">Tentang</a></li>
                <li><a href="<?php if(isset($_SESSION['auth'])){echo "../";}?>#produk">Produk</a></li>
                <li><a href="<?php if(isset($_SESSION['auth'])){echo "../";}?>#solusi">Solusi</a></li>
                <li><a href="<?php if(isset($_SESSION['auth'])){echo "../";}?>#kontak">Kontak</a></li>
                <?php if(isset($_SESSION['v'])){?>
                <li><a href="auth/masuk" class="a-active">Masuk</a></li>
                <?php }?>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>
<?php }if(isset($_SESSION['id-user'])){?>
    <header>
        <a href="#page-top" class="logo"><img src="assets/img/water.png" alt=""></a>
        <div class="menu-toggle"><i class="fas fa-bars"></i></div>
        <nav><ul><?php if($_SESSION['id-role']==1){?>
                <li><a href=""></a></li>
            <?php }if($_SESSION['id-role']>1){?>
                <li><a href="./">Beranda</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="produk">Produk</a></li>
                <li><a href="#solusi">Solusi</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <?php if($_SESSION['id-role']==3){?>
                <li><a href="keranjang" style="font-size: 14px"><i class="fas fa-shopping-cart" style="font-size: 18px"></i> <?= $counts_keranjang?></a></li>
                <li><a href="kasir" style="margin-left: -15px;margin-right: 20px;font-size: 14px"><i class="fas fa-cash-register" style="font-size: 18px"></i> <?= $counts_checkout?></a></li>
                <?php }?>
            <?php }?>
            <li><a href="auth/keluar" class="a-active">Keluar</a></li>
        </ul></nav>
        <div class="clearfix"></div>
    </header>
    <?php if($_SESSION['id-role']==2){?>
    <div class="nav">
        <ul>
            <li><a href="jadwal">Jadwal</a></li>
            <li><a href="catatan">Catatan</a></li>
            <li><a href="produk">Produk</a></li>
            <li><a href="penjualan">Penjualan</a></li>
            <li><a href="laporan">Laporan</a></li>
        </ul>
    </div>
<?php }}?>