<?php
require_once 'controller/connection.php';


$idEdit = $_SESSION['id'];
$queryEdit = mysqli_query($connection, "SELECT * FROM user WHERE id='$idEdit'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    if (!empty($_FILES['profile_picture']['name'])) {
        $namaFotoLama = $_FILES['profile_picture']['name'];

        $ext = array('jpg', 'jpeg', 'png', 'jfif', 'webp', 'heic');
        $img_ext = pathinfo($namaFotoLama, PATHINFO_EXTENSION);

        if (!in_array($img_ext, $ext)) {
            header("Location: ?pg=my-profile&error=ext");
        } else {
            unlink('img/profile_picture/' . $rowEdit['photo']);
            $new_image_name = "profile_picture" . $idEdit . "." . $img_ext;
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'img/profile_picture/' . $new_image_name);
            $queryEdit = mysqli_query($connection, "UPDATE user SET name='$name', email='$email', profile_picture='$new_image_name' WHERE id='$idEdit'");
        }
    }
    $queryEdit = mysqli_query($connection, "UPDATE user SET name='$name', email='$email' WHERE id='$idEdit'");
    header("Location: ?pg=my-profile&edit=success");
}

$queryLevel = mysqli_query($connection, "SELECT * FROM level");

if ((isset($_GET['pg']) == 'my-profile') && (isset($_GET['edit']) == 'success')) {
    header('location: ?pg=my-profile');
    die;
}

?>

<div class="wrapper">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">My Profile</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama"
                            value="<?= isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>" required>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email"
                            value="<?= isset($rowEdit['email']) ? $rowEdit['email'] : '' ?>" required>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-control" name="id_level" id="" disabled="true">
                            <option value=""> -- Add Level -- </option>
                            <?php while ($rowLevel = mysqli_fetch_assoc($queryLevel)) : ?>
                                <option value="<?= $rowLevel['id'] ?>"
                                    <?= isset($rowEdit['id_level']) && ($rowLevel['id'] == $rowEdit['id_level']) ? 'selected' : '' ?>>
                                    <?= $rowLevel['level_name'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <?php if ($rowEdit['id_level'] == 2) : ?>
                        <div class="col-sm-6 mb-3">
                            <label for="email" class="form-label">Jurusan</label>
                            <select class="form-control" name="id_jurusan" id="" disabled="true">
                                <option value=""> -- Add Jurusan -- </option>
                                <?php while ($rowJurusan = mysqli_fetch_assoc($queryJurusan)) : ?>
                                    <option value="<?= $rowJurusan['id'] ?>"
                                        <?= isset($rowEdit['id_jurusan']) && ($rowJurusan['id'] == $rowEdit['id_jurusan']) ? 'selected' : '' ?>>
                                        <?= $rowJurusan['nama_jurusan'] ?></option>
                                <?php endwhile ?>
                            </select>
                        </div>
                    <?php endif ?>
                    <div class="col-sm-6 mb-3">
                        <label for="photoProfile" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        <img width="50%" src="<?= !empty($rowEdit['profile_picture']) ? 'img/profile_picture/' . $rowEdit['profile_picture'] : 'https://placehold.co/100' ?>" alt="" class="mt-4 rounded">
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="edit">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>