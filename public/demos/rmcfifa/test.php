<?php
    if(!isset($_SESSION)){
        session_start();
        $_SESSION['tokenn']='kjlkjkljlkjlkjlkjlkj';
    }
    print_r(session_id());
    $tokens=$_SESSION['tokenn'];
    echo 'token'.$tokens;
    echo "\n";

    $user = posix_getpwuid(posix_geteuid());
    var_dump($user);
    echo "\n";

    phpinfo();
?>