<?php
require_once 'controller/connection.php';
include 'controller/admin-validation.php';
include 'controller/admin-operations.php';

if (isset($_GET['delete'])) {
    deleteRow($_GET['delete']);
    header("Location: ?pg=data-transaction&delete=success");
} else if (isset($_POST['add'])) {
    dataTransactionAdd();
    header("Location: ?pg=data-transaction&add=success");
} else if (isset($_GET['detail'])) {
    $idDetail = $_GET['detail'];
    $sql = "SELECT customer.customer_name, customer.phone, customer.address, trans_order.order_code, trans_order.order_date, trans_order.order_status, type_of_service.service_name, type_of_service.price, trans_order_detail.* 
    FROM trans_order_detail 
    LEFT JOIN type_of_service ON type_of_service.id = trans_order_detail.id_service 
    LEFT JOIN trans_order ON trans_order.id = trans_order_detail.id_order 
    LEFT JOIN customer ON trans_order.id_customer = customer.id 
    WHERE trans_order_detail.id_order ='$idDetail'";
    $queryDetail = mysqli_query($connection, $sql);
    $rowDetail = [];
    while ($data = mysqli_fetch_assoc($queryDetail)) {
        $rowDetail[] = $data;
    }
}

$queryCustomer = mysqli_query($connection, "SELECT * FROM customer WHERE deleted_at=0");
$currentDate = date("l, d-m-Y");
$queryService = mysqli_query($connection, "SELECT * FROM type_of_service WHERE deleted_at=0");
$order_code = dataTransactionGetNoInvoice();

?>

<?php if (isset($_GET['detail'])) : ?>
    <div class="wrapper flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-sm-12 mb-3"></div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Transaction Data</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-responsive">
                            <tr>
                                <th>Order Code</th>
                                <td><?= $rowDetail[0]['order_code'] ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Laundry</th>
                                <td><?= $rowDetail[0]['order_date'] ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <?php
                                switch ($rowDetail[0]['order_status']) {
                                    case 0:
                                        $status = "<span class='badge bg-warning'>New</span>";
                                        break;
                                    case 1:
                                        $status = "<span class='badge bg-success'>Done</span>";
                                        break;
                                    default:
                                        $status = "<span>Unknown</span>";
                                        break;
                                }
                                ?>
                                <td><?= $status ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Customer Detail</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-responsive">
                            <tr>
                                <th>Name</th>
                                <td><?= $rowDetail[0]['customer_name'] ?></td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td><?= $rowDetail[0]['phone'] ?></td>
                            </tr>
                            <tr>
                                <th>Addres</th>
                                <td><?= $rowDetail[0]['address'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h5>Transaction Detail</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Service Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($rowDetail as $key => $value):
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $value['service_name'] ?></td>
                                        <td><?= "Rp. " . number_format($value['price'], 2) ?></td>
                                        <td><?= $value['qty'] ?></td>
                                        <td><?= "Rp. " . number_format($value['subtotal'], 2) ?></td>
                                    </tr>
                                <?php endforeach  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else : ?>
    <div class="wrapper flex-grow-1 container-p-y">
        <form action="" method="post">
            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="card-title">Add Transaction</h3>
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
                                        value="<?= $order_code ?>" readonly>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="order_date" class="form-label">Order Date:</label>
                                    <input class="form-control" id="order_date" name="order_date" placeholder="Masukkan order date"
                                        value="<?= $currentDate ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="card-title">Detail Transaction</h3>
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
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endif ?>