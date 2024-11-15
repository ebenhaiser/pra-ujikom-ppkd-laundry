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
        $order_code = $_POST['order_code'];
        $order_date = $_POST['order_date'];
        $order_status = $_POST['order_status'];
        $id_customer = $_POST['id_customer'];

        $queryEdit = mysqli_query($connection, "UPDATE trans_order SET order_code='$order_code', order_date='$order_date', order_status='$order_status', id_customer='$id_customer' WHERE id='$idEdit'");
        header("Location: ?pg=data-order&edit=success");
    }
} else if (isset($_POST['add'])) {
    $order_code = $_POST['order_code'];
    $order_date = $_POST['order_date'];
    $order_status = $_POST['order_status'];
    $id_customer = $_POST['id_customer'];

    $queryAdd = mysqli_query($connection, "INSERT INTO trans_order (order_code, order_date, order_status, id_customer) VALUES ('$order_code', '$order_date', '$order_status', '$id_customer')");
    header("Location: ?pg=data-order&add=success");
}

$queryCustomerAdd = mysqli_query($connection, "SELECT * FROM customer WHERE deleted_at=0");
$queryCustomerEdit = mysqli_query($connection, "SELECT * FROM customer");
?>

<div class="wrapper">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Data Order</h3>
            <form action="" method="post">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label for="order_code" class="form-label">Order Code:</label>
                        <input type="text" class="form-control" id="order_code" name="order_code" placeholder="Masukkan nama"
                            value="<?= isset($_GET['edit']) ? $rowEdit['order_code'] : '' ?>" required>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="order_date" class="form-label">Customer Name:</label>
                        <select name="id_customer" id="">
                            <?php if (isset($_GET['edit'])) : ?>
                                <option value=""> -- choose customer -- </option>
                                <?php while ($rowCustomer = mysqli_num_rows($queryCustomerEdit)) : ?>
                                    <option value="<?= $rowCustomer['id'] ?>" <?php $rowCustomer['id'] == $rowEdit['id_customer'] ? 'selected' : '' ?>><?php $rowCustomer['order_code'] ?></option>
                                <?php endwhile ?>
                            <?php else : ?>
                                <?php while ($rowCustomer = mysqli_num_rows($queryCustomerAdd)) : ?>
                                    <option value="<?= $rowCustomer['id'] ?>"><?php $rowCustomer['order_code'] ?></option>
                                <?php endwhile ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="order_status" class="form-label">Order Date:</label>
                        <input type="date" class="form-control" id="order_date" name="order_date" placeholder="Masukkan order_date"
                            value="<?= isset($_GET['edit']) ? $rowEdit['order_date'] : '' ?>" required>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="order_status" class="form-label">Order Status:</label>
                        <select name="order_status" id="">
                            <option value="0" <?php isset($_GET['edit']) && $rowEdit['order_status'] == 0 ? 'selected' : '' ?>>New</option>
                            <option value="1" <?php isset($_GET['edit']) && $rowEdit['order_status'] == 1 ? 'selected' : '' ?>>Done</option>
                        </select>
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