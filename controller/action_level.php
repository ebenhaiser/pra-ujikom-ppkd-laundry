<?php
include '../config/db.php';

// select data level
$sqlDataLevel = mysqli_query($connection, "SELECT * FROM level ORDER BY id DESC");
