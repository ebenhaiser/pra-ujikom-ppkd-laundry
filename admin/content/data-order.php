<?php
include 'controller/admin-validation.php';

$queryDataOrder = mysqli_query($connection, "SELECT trans_order.*, customer.customer_name FROM trans_order LEFT JOIN customer ON trans_order.id_customer = customer.id WHERE trans_order.deleted_at=0 ORDER BY trans_order.order_date DESC");
?>

<div class="wrapper">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">Transaction Laundry</h3>
            <div align="right" class="button-action">
                <a href="?pg=add-data-order" class="btn btn-primary">Add</a>
            </div>
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
                    while ($rowDataOrder = mysqli_fetch_assoc($queryDataOrder)) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= isset($rowDataOrder['order_code']) ? $rowDataOrder['order_code'] : '' ?></td>
                            <td><?= isset($rowDataOrder['customer_name']) ? $rowDataOrder['customer_name'] : '' ?></td>
                            <td><?= isset($rowDataOrder['order_date']) ? $rowDataOrder_date['order'] : '' ?></td>
                            <?php
                            switch ($rowDataOrder['order_status']) {
                                case 0:
                                    $status = 'New';
                                    break;
                                case 1:
                                    $status = 'Done';
                                    break;
                                default:
                                    $status = 'Unknown';
                                    break;
                            }
                            ?>
                            <td><?= $status ?></td>
                            <td>
                                <a href="?pg=add-data-order&print=<?php echo $rowDataOrder['id'] ?>">
                                    <button class="btn btn-light">
                                        <span class="tf-icon bx bx-print bx-18px"></span>
                                    </button>
                                </a>
                                |
                                <a onclick="return confirm ('Apakah anda yakin akan menghapus data ini?')"
                                    href="?pg=add-data-order&delete=<?php echo $rowDataOrder['id'] ?>">
                                    <button class="btn btn-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
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