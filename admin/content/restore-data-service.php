<?php
require_once 'controller/connection.php';
include 'controller/admin-validation.php';

if (isset($_POST['delete'])) {
    $idDelete = $_GET['restore'];
    $query = mysqli_query($connection, "DELETE FROM type_of_service WHERE id='$idDelete'");
    header("Location: ?pg=recycle-bin-data-service&delete=success");
} else if (isset($_GET['delete-row'])) {
    $idDelete = $_GET['delete-row'];
    $query = mysqli_query($connection, "DELETE FROM type_of_service WHERE id='$idDelete'");
    header("Location: ?pg=recycle-bin-data-service&delete=success");
} else if (isset($_GET['delete-all'])) {
    $queryDeleteAll = mysqli_query($connection, "DELETE FROM type_of_service WHERE deleted_at=1");
    header("Location:?pg=recycle-bin-data-service&deleted=all=success");
} else if (isset($_GET['restore'])) {
    $idRestore = $_GET['restore'];
    $queryRestore = mysqli_query($connection, "SELECT * FROM type_of_service WHERE id='$idRestore'");
    $rowRestore = mysqli_fetch_assoc($queryRestore);

    if (isset($_POST['restore'])) {
        $queryRestore = mysqli_query($connection, "UPDATE type_of_service SET deleted_at=0 WHERE id='$idRestore'");
        header("Location:?pg=recycle-bin-data-service&restore=success");
    }
} else if (isset($_GET['restore-row'])) {
    $idRestore = $_GET['restore-row'];
    $queryRestore = mysqli_query($connection, "UPDATE type_of_service SET deleted_at=0 WHERE id='$idRestore'");
    header("Location:?pg=recycle-bin-data-service&restore=success");
} else if (isset($_GET['restore-all'])) {
    $queryRestoreAll = mysqli_query($connection, "SELECT * FROM type_of_service WHERE deleted_at=1");

    while ($rowRestoreAll = mysqli_fetch_assoc($queryRestoreAll)) {
        $IDRestoreAll = $rowRestoreAll['id'];
        $restoreAll = mysqli_query($connection, "UPDATE type_of_service SET deleted_at=0 WHERE id='$IDRestoreAll'");
    }
    header("Location:?pg=recycle-bin-data-service&restore=success");
}

?>

<div class="wrapper">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">Restore Data Customer</h3>
            <form action="" method="post">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label for="service_name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Masukkan nama"
                            value="<?= isset($_GET['restore']) ? $rowRestore['service_name'] : '' ?>" readonly>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label">Phone</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan price"
                            value="<?= isset($_GET['restore']) ? $rowRestore['price'] : '' ?>" readonly>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" for="description" readonly
                            placeholder="Masukkan description" <?= isset($_GET['restore']) ? '' : 'required' ?>><?= isset($_GET['restore']) ? $rowRestore['description'] : '' ?></textarea>
                    </div>
                    <!-- <div class="col-sm-6 mb-3">
            <label for="password" class="form-label">password</label>
            <input type="password" class="form-control" id="password" name="password" for="password"
              placeholder="Masukkan password" <?= isset($_GET['restore']) ? '' : 'required' ?>>
          </div> -->
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