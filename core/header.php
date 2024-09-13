<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnnexBios</title>

    <link rel="icon" type="image/png" href="assets/img/popcornicon.png"

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
                <select name="filmchoice">
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