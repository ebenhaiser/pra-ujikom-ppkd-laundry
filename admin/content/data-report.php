<?php
include 'controller/admin-validation.php';

$order_date_start = isset($_GET['order_date_start']) ? $_GET['order_date_start'] : '';
$order_date_end = isset($_GET['order_date_end']) ? $_GET['order_date_end'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "SELECT trans_order.*, customer.customer_name FROM trans_order LEFT JOIN customer ON trans_order.id_customer = customer.id WHERE trans_order.deleted_at=0 ";

if ($status != '') {
    $sql .= " AND trans_order.order_status='$status'";
}

if ($order_date_start != '') {
    $sql .= " AND trans_order.order_date BETWEEN '$order_date_start' AND '$order_date_end' ";
}

$sql .= " ORDER BY trans_order.id DESC";
$queryReport = mysqli_query($connection, $sql);

if (isset($_GET['clear'])) {
    header("Location: ?pg=data-report");
}
?>

<div class="wrapper flex-grow-1 container-p-y">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">Data Report</h3>
            <!-- <div align="right" class="button-action">
                <a href="?pg=add-data-transaction" class="btn btn-primary">Add</a>
            </div> -->
            <!-- filter data -->
            <form action="" method="get">
                <div class="mb-3 row">
                    <div class="col-sm-3">
                        <label for="">Date From</label>
                        <input type="date" name="order_date_start" class="form-control" value="<?= isset($_GET['order_date_start']) ? $_GET['order_date_start'] : '' ?>">
                    </div>
                    <div class="col-sm-3">
                        <label for="">Date Done</label>
                        <input type="date" name="order_date_end" class="form-control" value="<?= isset($_GET['order_date_end']) ? $_GET['order_date_end'] : '' ?>">
                    </div>
                    <div class="col-sm-3">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value=""> -- status -- </option>
                            <option value="0" <?= isset($_GET['status']) && ($_GET['status'] == 0) ? 'selected' : '' ?>>New</option>
                            <option value="1" <?= isset($_GET['status']) && ($_GET['status'] == 1) ? 'selected' : '' ?>>Done</option>
                        </select>
                    </div>
                    <input type="hidden" name="pg" value="data-report">
                    <div class="col-sm-3 d-flex align-items-bottom gap-3">
                        <button class="btn btn-primary" name="filter">Sort</button>
                        <button class="btn btn-secondary" name="clear">Clear</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered table-striped table-hover table-responsive mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Code</th>
                        <th>Customer Name</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($rowReport = mysqli_fetch_assoc($queryReport)) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= isset($rowReport['order_code']) ? $rowReport['order_code'] : '' ?></td>
                            <td><?= isset($rowReport['customer_name']) ? $rowReport['customer_name'] : '' ?></td>
                            <td><?= isset($rowReport['order_date']) ? $rowReport['order_date'] : '' ?></td>
                            <?php
                            switch ($rowReport['order_status']) {
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
                            <td>
                                <a href="?pg=add-data-transaction&detail=<?php echo $rowReport['id'] ?>">
                                    <button class="btn btn-light">
                                        <span class="tf-icon bx bx-show bx-18px"></span>
                                    </button>
                                </a>
                                |
                                <a href="print.php?id=<?php echo $rowReport['id'] ?>">
                                    <button class="btn btn-light">
                                        <span class="tf-icon bx bx-printer bx-18px"></span>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; // End While 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>