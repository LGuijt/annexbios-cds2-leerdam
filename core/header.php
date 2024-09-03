<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FruitFishArt</title>

    <link rel="stylesheet" href="<?= BASEURL . 'assets/css/style.css' ?>">
    <?php
    if ($style != '') {
        ?>
        <link rel="stylesheet" href="<?= BASEURL . 'assets/css/' . $style ?>">
        <?php
    }
    ?>

    <script src="<?= BASEURL . 'assets/js/app.js' ?>" defer></script>
    <?php
    if ($js != '') {
        ?>
        <script src="<?= BASEURL . 'assets/js/' . $js ?>" defer></script>
        <?php
    }
    ?>
</head>

<body>
    <div id="mainHeader">
        <div id="upperHalf"></div>
        <div id="lowerHalf"></div>
    </div>
</body>