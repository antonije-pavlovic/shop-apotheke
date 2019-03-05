<?php
    session_start();
    if(isset($_POST['send'])){
        unset($_SESSION['user']);
        session_destroy();
        echo http_response_code(200);
    }else{
        echo http_response_code(500);
    }