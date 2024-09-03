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
    <div id="mainHeader">
        <div id="upperHalf">
            <div id="logo">
                <img src="./assets/img/logo.png">
            </div>
            <div id="menu">
                <a href="">FILM AGENDA</a>
                <a href="agenda">ALLE VESTIGINGEN</a>
                <a href="bestel">CONTACT</a>
            </div>
        </div>
        <div id="lowerHalf">
            <form>
                <div>KOOP JE TICKETS</div>
                <select>
                    <option>film 1</option>
                    <option>film 2</option>
                </select>
                <input type="submit" value="Bestel TICKETS">
            </form>
        </div>
    </div>