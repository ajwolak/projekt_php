<?php
session_start();
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
    header("Location: /home/");
} else {
    header("Location: /login/");
}
