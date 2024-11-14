<?php

$connection = mysqli_connect("localhost", "root", "", "angkatan3_laundry");

if (!$connection) {
    echo "gagal konak, eh konek";
    die;
}
