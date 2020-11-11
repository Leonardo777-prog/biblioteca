<?php
require_once '../libs/header.php';
// unset($_SESSION);
session_destroy();
header('Location: login.php');

?>