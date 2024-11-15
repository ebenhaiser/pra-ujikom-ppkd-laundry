<?php
require_once 'controller/connection.php';
include 'controller/admin-validation.php';

if (isset($_POST['delete'])) {
  $idDelete = $_GET['restore'];
  $query = mysqli_query($connection, "DELETE FROM user WHERE id='$idDelete'");
  header("Location: ?pg=recycle-bin-data-user&delete=success");
} else if (isset($_GET['delete-row'])) {
  $idDelete = $_GET['delete-row'];
  $query = mysqli_query($connection, "DELETE FROM user WHERE id='$idDelete'");
  header("Location: ?pg=recycle-bin-data-user&delete=success");
} else if (isset($_GET['delete-all'])) {
  $queryDeleteAll = mysqli_query($connection, "DELETE FROM user WHERE deleted_at=1");
  header("Location:?pg=recycle-bin-data-user&deleted=all=success");
} else if (isset($_GET['restore'])) {
  $idRestore = $_GET['restore'];
  $queryRestore = mysqli_query($connection, "SELECT * FROM user WHERE id='$idRestore'");
  $rowRestore = mysqli_fetch_assoc($queryRestore);

  if (isset($_POST['restore'])) {
    $queryRestore = mysqli_query($connection, "UPDATE user SET deleted_at=0 WHERE id='$idRestore'");
    header("Location:?pg=recycle-bin-data-user&restore=success");
  }
} else if (isset($_GET['restore-row'])) {
  $idRestore = $_GET['restore-row'];
  $queryRestore = mysqli_query($connection, "UPDATE user SET deleted_at=0 WHERE id='$idRestore'");
  header("Location:?pg=recycle-bin-data-user&restore=success");
} else if (isset($_GET['restore-all'])) {
  $queryRestoreAll = mysqli_query($connection, "SELECT * FROM user WHERE deleted_at=1");

  while ($rowRestoreAll = mysqli_fetch_assoc($queryRestoreAll)) {
    $IDRestoreAll = $rowRestoreAll['id'];
    $restoreAll = mysqli_query($connection, "UPDATE user SET deleted_at=0 WHERE id='$IDRestoreAll'");
  }
  header("Location:?pg=recycle-bin-data-user&restore=success");
}

$queryLevel = mysqli_query($connection, "SELECT * FROM level");
?>

<div class="wrapper">
  <div class="card mt-3">
    <div class="card-body">
      <h3 class="card-title">Restore Data User</h3>
      <form action="" method="post">
        <div class="row">
          <div class="col-sm-6 mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama"
              value="<?= isset($_GET['restore']) ? $rowRestore['name'] : '' ?>" readonly>
          </div>
          <div class="col-sm-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email"
              value="<?= isset($_GET['restore']) ? $rowRestore['email'] : '' ?>" readonly>
          </div>
          <div class="col-sm-6 mb-3">
            <label for="level" class="form-label">Level</label>
            <select class="form-control" name="id_level" id="" disabled="true">
              <option value=""> -- Add Level -- </option>
              <?php while ($rowLevel = mysqli_fetch_assoc($queryLevel)) : ?>
                <option value="<?= $rowLevel['id'] ?>"
                  <?= isset($_GET['restore']) && ($rowLevel['id'] == $rowRestore['id_level']) ? 'selected' : '' ?>>
                  <?= $rowLevel['level_name'] ?></option>
              <?php endwhile ?>
            </select>
          </div>
          <!-- <div class="col-sm-6 mb-3">
            <label for="password" class="form-label">password</label>
            <input type="password" class="form-control" id="password" name="password" for="password"
              placeholder="Masukkan password" <?= isset($_GET['restore']) ? '' : 'required' ?>>
          </div> -->
        </div>
        <div class="mb-3 mt-1">
          <button type="submit" class="btn" style="background-color: #00bf0d; color:white;" name="restore">
            Restore
          </button>
          <button onclick="return confirm ('Apakah anda yakin akan menghapus data ini?')" type="submit" class="btn" style="background-color: #f01202; color:white;" name="delete">
            Delete
          </button>
        </div>
      </form>
    </div>
  </div>
</div>