<?php if(!isset($_SESSION)){session_start();}
    $_SESSION=[];
    session_unset();
    session_destroy();
    header("Location: ../");
    exit;