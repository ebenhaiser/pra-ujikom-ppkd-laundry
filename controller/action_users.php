<?php
include '../config/db.php';

// select user
$sqlDataUser = mysqli_query($connection, "SELECT users.*, level.nama_level FROM users LEFT JOIN level ON users.id_level = level.id");
