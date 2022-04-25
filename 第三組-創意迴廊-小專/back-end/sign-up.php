<?php
session_start();
session_destroy();

header("location: Login/back-end-login.php");
?>