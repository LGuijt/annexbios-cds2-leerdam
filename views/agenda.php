<?php include 'core/header.php'; ?>

<div class="parentContainer" style="height: 210vh;">
    <div id="blackBackground"></div>
    <div id="whiteBoxesContainer">
        <div id="titleBox">FILM AGENDA</div>
        <div id="filters">
            <img id="settingsImage" src="./assets/img/settings.png">
            <div class="whiteBox" id="filmsBox">
                <img id="filmsBoxImage" src="./assets/img/unchecked.png" style="margin-right: 0.5vw;">FILMS
            </div>
            <div class="whiteBox" id="thisWeekBox">
                <img id="thisWeekBoxImage" src="./assets/img/unchecked.png" style="margin-right: 0.5vw;">DEZE WEEK
            </div>
            <div class="whiteBox" id="todayBox">
                <img id="todayBoxImage" src="./assets/img/unchecked.png" style="margin-right: 0.5vw;">VANDAAG
            </div>
            <div class="whiteBox" id="categoryBox">
                <img id="categoryBoxImage" src="./assets/img/unchecked.png" style="margin-right: 0.5vw;">CATEGORIE
                <div style="width:1.8vw;"></div>
                <div id="dropDownArrow" style="transform: scaleX(2);">V</div>
            </div>
        </div>
    </div>

    <div id="movieContainer">
        <?php
        // Loop over the movie data
        foreach ($moviedata as $index => $movie) {
            // Every 2 movies, open a new row
            if ($index % 2 == 0) { ?>
                <div class="movieRow">
                <?php } ?>

                <div class="movieColumn">
                    <img id="movieImage" src="https://placehold.co/254x402">
                    <div style="padding: .75vw;">
                        <div id="movieTitle"><?= $movie['title']; ?></div>
                        <div id="starContainer">
                            <?php
                            $filledStars = floor($movie["rating"] / 2);
                            $unfilledStars = 5 - $filledStars;
                            for ($k = 0; $k < $filledStars; $k++) { ?>
                                <img class="star" src="./assets/img/star_filled.png">
                            <?php }
                            for ($k = 0; $k < $unfilledStars; $k++) { ?>
                                <img class="star" src="./assets/img/star_unfilled.png">
                            <?php } ?>
                        </div>
                        <div id="releaseText"><?=$movie["release_date"];?></div>
                        <div id="description"><?=$movie['description'];?></div>
                        <div id="ticketsButton">MEER INFO & TICKETS</div>
                    </div>
                </div>

                <?php
                // Every 2 movies, close the row
                if ($index % 2 == 1) { ?>
                </div>
            <?php }
        } ?>
    </div>

    <?php include 'core/footer.php'; ?>