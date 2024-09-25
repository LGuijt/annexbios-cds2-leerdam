<?php

include_once '../../core/db_connect.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $input = json_decode(file_get_contents('php://input'), true);
    $voucher = $input['voucher'];
    $voucherTrue = false;
    $discount = 0;

    // $voucherquery = "SELECT code, amount FROM vouchers WHERE code = ?";
    $voucherStmt = $con->prepare("SELECT code, amount FROM vouchers WHERE code = ?");
    $voucherStmt->bind_param('s', $voucher);
    $voucherStmt->bind_result($code, $amount);
    $voucherStmt->execute();
    while($voucherStmt->fetch()){
        if ($voucher == $code) {
            $voucherTrue = true;
            $discount = $amount;
        } else {
            $voucherTrue = false;
            $discount = 0;
        }
    }

    $response = [
        "status" => "POST",
        "message" => "POST request received",
        "input" => $voucher,
        "valid" => $voucherTrue,
        "discount" => $discount
    ];

    echo json_encode($response);
}