<?php
require_once 'connection.php';

if (isset($_POST['register'])) {
  $id_level = $_POST['id_level'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $queryRegister = mysqli_query($connection, "INSERT INTO user (id_level, name, email, password) VALUES ('$id_level', '$name', '$email', '$password')");


  if ($queryRegister) {
    // echo "<script>alert('Register Berhasil')</script>";
    header("Location: ../login.php");
  }
}
