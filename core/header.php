<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnnexBios</title>

    <link rel="icon" type="image/png" href="assets/img/popcornicon.png">

    <link rel="stylesheet" href="<?= 'assets/css/style.css' ?>">
    <link rel="stylesheet" href="<?= 'assets/css/header.css' ?>">
    <link rel="stylesheet" href="<?= 'assets/css/footer.css' ?>">
    <link rel="stylesheet" href="<?= 'assets/css/home.css' ?>">

    <?php
    if ($style != '') {
        ?>
        <link rel="stylesheet" href="<?= 'assets/css/' . $style ?>">
        <?php
    }
    ?>

    <script src="<?= 'assets/js/app.js' ?>" defer></script>
    <?php
    if ($js != '') {
        ?>
        <script src="<?= 'assets/js/' . $js ?>" defer></script>
        <?php
    }
    ?>
</head>

<body>
    <?php

    $authorization = "Authorization: Bearer 2b8e7f9a3c1d5e4f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6a7b8c9d";
    $url = 'https://annexbios.nickvz.nl/api/v1/movieData';

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Execute cURL request
    $result = curl_exec($ch);

    // Check for cURL errors
    if ($result === false) {
        echo 'cURL Error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);


    // var_dump($result);
    $res = json_decode($result, true);
    // var_dump($res['data']);
    $moviedata = $res['data'];
    // var_dump($moviedata);
// $file_json = file_get_contents('assets/json/dummylocation.json');
// $locationdata = json_decode($file_json, true);
// $file_json = file_get_contents('assets/json/dummymovie.json');
// $moviedata = json_decode($file_json, true);
    $lurl = 'https://annexbios.nickvz.nl/api/v1/playingMovies/';
    $lch = curl_init($lurl);

    // Set cURL options
    curl_setopt($lch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
    curl_setopt($lch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($lch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($lch, CURLOPT_FOLLOWLOCATION, true);

    // Execute cURL request
    $locationresult = curl_exec($lch);

    // Check for cURL errors
    if ($locationresult === false) {
        echo 'cURL Error: ' . curl_error($lch);
    }

    // Close cURL session
    curl_close($lch);


    // var_dump($result);
    $locationres = json_decode($locationresult, true);
    // var_dump($locationres);
    $locationdata = $locationres['data'];
    //  var_dump($locationdata);
    
    ?>
    <div id="mainHeader">
        <div id="upperHalf">
            <div id="logo">
                <a href="./">
                    <img src="./assets/img/logo.png">
                </a>
            </div>
            <div id="menu">
                <a href="./agenda">FILM AGENDA</a>
                <a href="https://youtu.be/dQw4w9WgXcQ?si=4hVxHUqrSJKu_8ZA">ALLE VESTIGINGEN</a>
                <a href="https://youtu.be/dQw4w9WgXcQ?si=4hVxHUqrSJKu_8ZA">CONTACT</a>
            </div>
        </div>
        <div id="lowerHalf">
            <form method="post" action="bestel">
                <div>KOOP JE TICKETS</div>
                <select name="filmchoice" id="filmchoice">
                    <option>Kies je film</option>
                    <?php
                    foreach ($moviedata as $movie) {
                        foreach ($locationdata as $location) {
                            if ($movie['api_id'] == $location['movie_id']) {
                                ?>
                                <option value="<?= $movie['api_id'] ?>"><?= $movie['title'] ?></option>
                                <?php
                            }
                        }

                    }
                    ?>
                </select>
                <input type="submit" value="BESTEL TICKETS">
            </form>
        </div>
    </div>