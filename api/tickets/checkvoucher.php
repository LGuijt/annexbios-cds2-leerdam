<?php

include_once '../../core/db_connect.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $input = json_decode(file_get_contents('php://input'), true);
    $voucher = $input['voucher'];
    $vouchertrue = false;
    $discount = 0;

    $voucherquery = "SELECT code, amount FROM vouchers WHERE code = ?";
    $voucherstmt = $con->prepare("SELECT code, amount FROM vouchers WHERE code = ?");
    $voucherstmt->bind_param('s', $voucher);
    $voucherstmt->bind_result($code, $amount);
    $voucherstmt->execute();
    while($voucherstmt->fetch()){
        if ($voucher == $code) {
            $vouchertrue = true;
            $discount = $amount;
        } else {
            $vouchertrue = false;
            $discount = 0;
        }
    }

    $response = [
        "status" => "POST",
        "message" => "POST request received",
        "input" => $voucher,
        "valid" => $vouchertrue,
        "discount" => $discount
    ];

    echo json_encode($response);
}