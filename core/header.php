<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FruitFishArt</title>

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
    $file_json = file_get_contents('assets/json/dummylocation.json');
    $locationdata = json_decode($file_json, true);

    $file_json = file_get_contents('assets/json/dummymovie.json');
    $moviedata = json_decode($file_json, true);
    ?>
    <div id="mainHeader">
        <div id="upperHalf">
            <div id="logo">
                <img src="./assets/img/logo.png">
            </div>
            <div id="menu">
                <a href="">FILM AGENDA</a>
                <a href="">ALLE VESTIGINGEN</a>
                <a href="">CONTACT</a>
            </div>
        </div>
        <div id="lowerHalf">
            <form method="post" action="bestel">
                <div id="tekst">KOOP JE TICKETS</div>
                <select name="filmkeuze">
                    <option>Kies je film</option>
                    <?php 
                    foreach ($moviedata as $movie) {
                        foreach ($locationdata as $location) {
                            if ($location["id"] == 3 && $location["movie_id"] == $movie["api_id"]) {
                                ?>
                                <option value="<?= $movie['api_id']; ?>"><?= $movie['title']; ?></option>
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