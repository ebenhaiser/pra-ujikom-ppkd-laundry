<?php
require_once 'controller/connection.php';
include 'controller/admin-validation.php';

if (isset($_GET['delete'])) {
  $idDelete = $_GET['delete'];
  $query = mysqli_query($connection, "UPDATE level SET deleted_at=1 WHERE id='$idDelete'");
  header("Location: ?pg=data-level&delete=success");
} else if (isset($_GET['edit'])) {
  $idEdit = $_GET['edit'];
  $queryEdit = mysqli_query($connection, "SELECT * FROM level WHERE id='$idEdit'");
  $rowEdit = mysqli_fetch_assoc($queryEdit);

  if (isset($_POST['edit'])) {
    $level_name = $_POST['level_name'];

    $queryEdit = mysqli_query($connection, "UPDATE level SET level_name='$level_name' WHERE id='$idEdit'");
    header("Location: ?pg=data-level&edit=success");
  }
} else if (isset($_POST['add'])) {
  $level_name = $_POST['level_name'];

  $queryAdd = mysqli_query($connection, "INSERT INTO level (level_name) VALUES ('$level_name')");
  header("Location: ?pg=data-level&add=success");
}
?>

<div class="wrapper">
  <div class="card mt-3 ">
    <div class="card-body">
      <h3 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Data Level</h3>
      <form action="" method="post">
        <div class="row">
          <div class="col-sm-6 mb-3">
            <label for="level_name" class="form-label">Nama Level</label>
            <input type="text" class="form-control" id="level_name" name="level_name" placeholder="Masukkan nama"
              value="<?= isset($_GET['edit']) ? $rowEdit['level_name'] : '' ?>" required>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'add' ?>">
              <?php echo isset($_GET['edit']) ? 'Atur' : 'Tambah' ?>
            </button>
          </div>
      </form>
    </div>
  </div>
</div>