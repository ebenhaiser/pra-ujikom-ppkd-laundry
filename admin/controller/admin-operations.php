<?php
include 'controller/connection.php';
$GLOBALS['connection'] = $connection;

function getRowEdit($table_name, $id)
{
    $query = mysqli_query($GLOBALS['connection'], "SELECT * FROM '$table_name' WHERE id='$id'");
    $row = mysqli_fetch_assoc($query);
    return $row;
}
function deleteRow($id)
{
    $query = mysqli_query($GLOBALS['connection'], "UPDATE trans_order SET deleted_at=1 WHERE id='$id'");
    return;
}

// data transaction
function dataTransactionAdd()
{
    // $connection = $GLOBALS['connection'];
    $id_customer = $_POST['id_customer'];
    $order_code = $_POST['order_code'];
    $order_date = $_POST['order_date'];
    $id_service = $_POST['id_service'];

    // insert ke table trans_order
    $queryInsert = mysqli_query($GLOBALS['connection'], "INSERT INTO trans_order (id_customer, order_code, order_date) VALUES ('$id_customer', '$order_code', '$order_date')");

    $last_id = mysqli_insert_id($GLOBALS['connection']);

    // insert ke table trans_detail_order
    foreach ($id_service as $key => $value) {
        $id_service = array_filter($_POST['id_service']);
        $qty = array_filter($_POST['qty']);
        $id_service = $_POST['id_service'][$key];
        $qty = $_POST['qty'][$key];

        // query untuk harga dari table pake
        $queryService = mysqli_query($GLOBALS['connection'], "SELECT id, price FROM type_of_service WHERE id='$id_service'");
        $rowService = mysqli_fetch_assoc($queryService);
        $price = isset($rowService['price']) ? $rowService['price'] : '';

        // subTotal
        $subTotal = (int)$qty * (int)$price;

        if (!empty($value)) {
            $insertTransDetail = mysqli_query($GLOBALS['connection'], "INSERT INTO trans_order_detail(id_order, id_service, qty, subtotal) VALUES ('$last_id', '$id_service', '$qty', '$subTotal')");
        }
    }
}

function dataTransactionGetNoInvoice()
{
    //  no invoice code
    // 001, jika ada auto increment id + 1 = 002, selain itu 001
    // SELECT MAX, ambil yang terbesar
    $sql = "SELECT MAX(id) AS no_invoice FROM trans_order";
    $queryInvoice = mysqli_query($GLOBALS['connection'], $sql);
    $str_unique = "INV";
    $date_now = date("dmY");
    if (mysqli_num_rows($queryInvoice)) {
        $rowInvoice = mysqli_fetch_assoc($queryInvoice);
        $incrementPlus = $rowInvoice['no_invoice'] + 1;
        $code = "000" . $incrementPlus;
    } else {
        $code = "0001";
    }
    $no_invoice = $str_unique . "-" . $date_now . "-" . $code;
    return $no_invoice;
}
// end data transaction
