<?php
session_start();

if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true) {
    // header("Location: home.php");
} else {
    header("Location: /login/");
}
