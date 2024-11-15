<?php
require_once 'controller/connection.php';
include 'controller/admin-validation.php';

if (isset($_POST['delete'])) {
  $idDelete = $_GET['restore'];
  $query = mysqli_query($connection, "DELETE FROM level WHERE id='$idDelete'");
  header("Location: ?pg=recycle-bin-data-level&delete=success");
} else if (isset($_GET['delete-row'])) {
  $idDelete = $_GET['delete-row'];
  $query = mysqli_query($connection, "DELETE FROM level WHERE id='$idDelete'");
  header("Location: ?pg=recycle-bin-data-level&delete=success");
} else if (isset($_GET['delete-all'])) {
  $queryDeleteAll = mysqli_query($connection, "DELETE FROM level WHERE deleted_at=1");
  header("Location:?pg=recycle-bin-data-level&deleted=all=success");
} else if (isset($_GET['restore'])) {
  $idRestore = $_GET['restore'];
  $queryRestore = mysqli_query($connection, "SELECT * FROM level WHERE id='$idRestore'");
  $rowRestore = mysqli_fetch_assoc($queryRestore);

  if (isset($_POST['restore'])) {
    $queryRestore = mysqli_query($connection, "UPDATE level SET deleted_at=0 WHERE id='$idRestore'");
    header("Location:?pg=recycle-bin-data-level&restore=success");
  }
} else if (isset($_GET['restore-row'])) {
  $idRestore = $_GET['restore-row'];
  $queryRestore = mysqli_query($connection, "UPDATE level SET deleted_at=0 WHERE id='$idRestore'");
  header("Location:?pg=recycle-bin-data-level&restore=success");
} else if (isset($_GET['restore-all'])) {
  $queryRestoreAll = mysqli_query($connection, "SELECT * FROM level WHERE deleted_at=1");

  while ($rowRestoreAll = mysqli_fetch_assoc($queryRestoreAll)) {
    $IDRestoreAll = $rowRestoreAll['id'];
    $restoreAll = mysqli_query($connection, "UPDATE level SET deleted_at=0 WHERE id='$IDRestoreAll'");
  }
  header("Location:?pg=recycle-bin-data-level&restore=success");
}

?>

<div class="wrapper">
  <div class="card mt-3">
    <div class="card-body">
      <h3 class="card-title">Restore Data Level</h3>
      <form action="" method="post">
        <div class="row">
          <div class="col-sm-6 mb-3">
            <label for="level_name" class="form-label">Nama Level</label>
            <input type="text" class="form-control" id="level_name" name="level_name" placeholder="Masukkan nama"
              value="<?= isset($_GET['restore']) ? $rowRestore['level_name'] : '' ?>" readonly>
          </div>
          <div class="">
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