<?php
ob_start();
session_start();

function is_login() {
    return (isset($_SESSION['valid']) && isset($_SESSION['username']) && $_SESSION['valid'] && !empty($_SESSION['username']));
}