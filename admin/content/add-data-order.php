<?php
require_once 'controller/connection.php';
include 'controller/admin-validation.php';

if (isset($_GET['delete'])) {
    $idDelete = $_GET['delete'];
    $query = mysqli_query($connection, "UPDATE trans_order SET deleted_at=1 WHERE id='$idDelete'");
    header("Location: ?pg=data-order&delete=success");
} else if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    $queryEdit = mysqli_query($connection, "SELECT * FROM trans_order WHERE id='$idEdit'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);

    if (isset($_POST['edit'])) {
        $id_customer = $_POST['id_customer'];
        $order_code = $_POST['order_code'];
        $order_date = $_POST['order_date'];
        $order_status = $_POST['order_status'];

        $queryEdit = mysqli_query($connection, "UPDATE trans_order SET id_customer='$id_customer', order_code='$order_code', order_date='$order_date', order_status='$id_level' WHERE id='$idEdit'");
        header("Location: ?pg=data-order&edit=success");
    }
} else if (isset($_POST['add'])) {
    $id_customer = $_POST['id_customer'];
    $order_code = $_POST['order_code'];
    $order_date = $_POST['order_date'];
    $order_status = $_POST['order_status'];

    $queryAdd = mysqli_query($connection, "INSERT INTO trans_order (id_customer, order_code, order_date, order_status) VALUES ('$id_customer', '$order_code', '$order_date', '$order_status')");
    header("Location: ?pg=data-order&add=success");
}

$currentDate = date("l, d-m-Y");

$queryCustomer = mysqli_query($connection, "SELECT * FROM customer WHERE deleted_at=0");
$queryService = mysqli_query($connection, "SELECT * FROM type_of_service WHERE deleted_at=0");
$rowService = [];
while ($data = mysqli_fetch_assoc($queryService)) {
    $rowService[] = $data;
}
?>

<div class="wrapper">
    <div class="row mt-3">
        <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title">Add Transaction</h3>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <label for="level" class="form-label">Customer:</label>
                                <select class="form-control" name="id_customer" id="">
                                    <option value=""> -- choose customer -- </option>
                                    <?php while ($rowCustomer = mysqli_fetch_assoc($queryCustomer)) : ?>
                                        <option value="<?= $rowCustomer['id'] ?>">
                                            <?= $rowCustomer['customer_name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="order_code" class="form-label">Order Code:</label>
                                <input type="text" class="form-control" id="order_code" name="order_code"
                                    value="<?= isset($_GET['edit']) ? $rowEdit['order_code'] : '' ?>" readonly>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="order_date" class="form-label">Order Date:</label>
                                <input class="form-control" id="order_date" name="order_date" placeholder="Masukkan order date"
                                    value="<?= $currentDate ?>" readonly>
                            </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'add' ?>">
                                <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title">Detail Transaction</h3>
                    <form action="" method="post">
                        <div class="mb-3 row">
                            <div class="col-sm-3 d-flex align-items-center">
                                <label for="" class="form-label">Service Package</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control" name="id_service[]" id="">
                                    <option value=""> -- choose service -- </option>
                                    <?php foreach ($rowService as $key => $value) : ?>
                                        <option value="<?= $value['id'] ?>">
                                            <?= $value['service_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3 d-flex align-items-center">
                                <label for="" class="form-label">Quantity</label>
                            </div>
                            <div class="col-5">
                                <input type="number" name="qty[]" class="form-control" placeholder="Quantity">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3 d-flex align-items-center">
                                <label for="" class="form-label">Service Package</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control" name="id_service[]" id="">
                                    <option value=""> -- choose service -- </option>
                                    <?php foreach ($rowService as $key => $value) : ?>
                                        <option value="<?= $value['id'] ?>">
                                            <?= $value['service_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3 d-flex align-items-center">
                                <label for="" class="form-label">Quantity</label>
                            </div>
                            <div class="col-5">
                                <input type="number" name="qty[]" class="form-control" placeholder="Quantity">
                            </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'add' ?>">
                                <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>