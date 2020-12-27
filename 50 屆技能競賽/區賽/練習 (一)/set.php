<?php
    session_start();
    foreach ($_GET as $key => $value) {
        $_SESSION[$key] = $value;
    }
    header("Location:$_SESSION[url]");
?>