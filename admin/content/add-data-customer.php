<?php
require_once 'controller/connection.php';
include 'controller/admin-validation.php';

if (isset($_GET['delete'])) {
    $idDelete = $_GET['delete'];
    $query = mysqli_query($connection, "UPDATE customer SET deleted_at=1 WHERE id='$idDelete'");
    header("Location: ?pg=data-customer&delete=success");
} else if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    $queryEdit = mysqli_query($connection, "SELECT * FROM customer WHERE id='$idEdit'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);

    if (isset($_POST['edit'])) {
        $customer_name = $_POST['customer_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $queryEdit = mysqli_query($connection, "UPDATE customer SET customer_name='$customer_name', phone='$phone', address='$address' WHERE id='$idEdit'");
        header("Location: ?pg=data-customer&edit=success");
    }
} else if (isset($_POST['add'])) {
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $queryAdd = mysqli_query($connection, "INSERT INTO customer (customer_name, phone, address) VALUES ('$customer_name', '$phone', '$address')");
    header("Location: ?pg=data-customer&add=success");
}

$queryLevel = mysqli_query($connection, "SELECT * FROM level WHERE deleted_at=0");
?>

<div class="wrapper">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Data Customer</h3>
            <form action="" method="post">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label for="customer_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Masukkan nama"
                            value="<?= isset($_GET['edit']) ? $rowEdit['customer_name'] : '' ?>" required>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Masukkan phone"
                            value="<?= isset($_GET['edit']) ? $rowEdit['phone'] : '' ?>" required>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea type="address" class="form-control" id="address" name="address" for="address"
                            placeholder="Masukkan address" <?= isset($_GET['edit']) ? '' : 'required' ?>><?= isset($_GET['edit']) ? $rowEdit['address'] : '' ?></textarea>
                    </div>
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