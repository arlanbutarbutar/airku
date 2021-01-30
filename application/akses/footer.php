<footer>
    <div class="text-footer">
        <p>Dibuat oleh Mahasiswa UNWIRA Kupang. </p>
        <p class="italic"> Noreg 23118036.</p>
    </div>
</footer>
<script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>assets/js/jquery-3.5.1.min.js"></script>
<script> 
    $(document).ready(function(){
        $('.menu-toggle').click(function(){
            $('.menu-toggle').toggleClass('active')
            $('nav').toggleClass('active')
        })
    });
</script> 
<script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>assets/js/scroll.js"></script>