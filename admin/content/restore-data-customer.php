<?php
require_once 'controller/connection.php';
include 'controller/admin-validation.php';

if (isset($_POST['delete'])) {
    $idDelete = $_GET['restore'];
    $query = mysqli_query($connection, "DELETE FROM customer WHERE id='$idDelete'");
    header("Location: ?pg=recycle-bin-data-customer&delete=success");
} else if (isset($_GET['delete-row'])) {
    $idDelete = $_GET['delete-row'];
    $query = mysqli_query($connection, "DELETE FROM customer WHERE id='$idDelete'");
    header("Location: ?pg=recycle-bin-data-customer&delete=success");
} else if (isset($_GET['delete-all'])) {
    $queryDeleteAll = mysqli_query($connection, "DELETE FROM customer WHERE deleted_at=1");
    header("Location:?pg=recycle-bin-data-customer&deleted=all=success");
} else if (isset($_GET['restore'])) {
    $idRestore = $_GET['restore'];
    $queryRestore = mysqli_query($connection, "SELECT * FROM customer WHERE id='$idRestore'");
    $rowRestore = mysqli_fetch_assoc($queryRestore);

    if (isset($_POST['restore'])) {
        $queryRestore = mysqli_query($connection, "UPDATE customer SET deleted_at=0 WHERE id='$idRestore'");
        header("Location:?pg=recycle-bin-data-customer&restore=success");
    }
} else if (isset($_GET['restore-row'])) {
    $idRestore = $_GET['restore-row'];
    $queryRestore = mysqli_query($connection, "UPDATE customer SET deleted_at=0 WHERE id='$idRestore'");
    header("Location:?pg=recycle-bin-data-customer&restore=success");
} else if (isset($_GET['restore-all'])) {
    $queryRestoreAll = mysqli_query($connection, "SELECT * FROM customer WHERE deleted_at=1");

    while ($rowRestoreAll = mysqli_fetch_assoc($queryRestoreAll)) {
        $IDRestoreAll = $rowRestoreAll['id'];
        $restoreAll = mysqli_query($connection, "UPDATE customer SET deleted_at=0 WHERE id='$IDRestoreAll'");
    }
    header("Location:?pg=recycle-bin-data-customer&restore=success");
}

$queryLevel = mysqli_query($connection, "SELECT * FROM level");
?>

<div class="wrapper">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">Restore Data Customer</h3>
            <form action="" method="post">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label for="customer_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Masukkan nama"
                            value="<?= isset($_GET['restore']) ? $rowRestore['customer_name'] : '' ?>" readonly>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Masukkan phone"
                            value="<?= isset($_GET['restore']) ? $rowRestore['phone'] : '' ?>" readonly>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea type="address" class="form-control" id="address" name="address" for="address" readonly
                            placeholder="Masukkan address" <?= isset($_GET['restore']) ? '' : 'required' ?>><?= isset($_GET['restore']) ? $rowRestore['address'] : '' ?></textarea>
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