<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    var_dump($_POST);
    $name = $_POST['firstname'] . " " . $_POST['lastname'];
    $authorization = "Authorization: Bearer 2b8e7f9a3c1d5e4f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6a7b8c9d";

    // Specify the URL and data 
    $url = 'https://annexbios.nickvz.nl/api/v1/reservePlace';


    // Initialize cURL session 
    $ch = curl_init();

    for ($i = 0; $i < count($_POST['seat']); $i++) {
        $data = [
            'movie_id' => $_POST['filmid'],
            'place_id' => $_POST['seat'][$i],
            'name' => $name,
            'email' => $_POST['email'],
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session 
        $response = curl_exec($ch);

        // Check for cURL errors 
        if ($response === false) {
            die('Error occurred while fetching the data: '
                . curl_error($ch));
        }

    }
    curl_close($ch);
    echo $response;

}