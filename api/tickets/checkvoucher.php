<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $input = json_decode(file_get_contents('php://input'), true);
    $voucher = $input['voucher'];

    $response = [
        "status" => "POST",
        "message" => "POST request received",
        "input" => $voucher
    ];
    echo json_encode($response);
}