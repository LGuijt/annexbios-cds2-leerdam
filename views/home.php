<header>
    <?php include 'core/header.php'; ?>
</header>

<main>

    <div class="parentContainer" style="margin-top:30vh;">
        <div id="imageContainer">
            <div id="opacityBox"></div>
        </div>
        <div id="welcomeBox">
            <h1 style="font-size:3em;">WELKOM BIJ ANNEXBIOS LEERDAM</h1>
            <p style="width:40vw;font-size:1.5em;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam,
                dolore
                facilis. Quisquam commodi veniam, eius fugit ab exercitationem labore eum sit ullam eos reiciendis vitae
                ipsum corrupti inventore rerum distinctio.</p>
            <a style="text-decoration: none;" href="./agenda">
                <div id="referButton">BEKIJK DE DRAAIENDE FILMS</div>
            </a>
        </div>
        <div id="locationBox">
            <div id="informationBox">
                <div id="mapsImage">
                    <div style="text-decoration:none; overflow:hidden;max-width:100%;width:35vw;height:35vh;">
                        <div id="display-google-map" style="height:100%; width:100%;max-width:100%;">
                            <iframe style="height:100%;width:100%;border:0;" frameborder="0"
                                src="https://www.google.com/maps/embed/v1/place?q=Techniekweg+6+Leerdam&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                        </div>
                        <a class="googl-ehtml" href="https://www.bootstrapskins.com/themes"
                            id="get-data-for-embed-map">premium bootstrap themes</a>
                        <style>
                            #display-google-map img {
                                max-height: none;
                                max-width: none !important;
                                background: none !important;
                            }
                        </style>
                    </div>
                </div>
                <div id="information">
                    <div id="contactBox">
                        <div class="contactRow">
                            <img id="mapsImage" src="./assets/img/maps.png">
                            <div class="info">
                                <p class="infoP">Techniekweg 6</p>
                                <p class="infoP">4143 HV Leerdam</p>
                            </div>
                        </div>
                        <div class="contactRow">
                            <img id="phoneImage" src="./assets/img/phone.png">
                            <div class="info">
                                <p class="infoP">0345-637987</p>
                            </div>
                        </div>
                    </div>
                    <div id="aproachText">
                        <p style="font-size: 20px;color:white;margin-block-start:0;margin-block-end:0;">BEREIKBAARHEID
                        </p>
                        <p style="color:white;margin-block-start:0;margin-block-end:0;">Lorem ipsum dolor sit amet
                            consectetur adipisicing elit. Mollitia dolor quo at quisquam cupiditate est architecto,
                            laboriosam temporibus alias necessitatibus!</p>
                    </div>
                </div>
            </div>
            <img id="locationImage" src="./assets/img/locatie.png" style="height:63vh;margin-left:2vw;width:50%;">
        </div>
    </div>

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
                <?php

                $genres = array();
                foreach ($moviedata as $movie) {
                    foreach ($movie["genres"] as $genre) {
                        $genreName = strtolower($genre["name"]);
                        if (!in_array($genreName, $genres)) {
                            $genres[] = $genreName;
                        }
                    }
                }
                ?>

                <div class="whiteBox" id="categoryBox">
                    <img id="categoryBoxImage" src="./assets/img/unchecked.png" style="margin-right: 0.5vw;">CATEGORIE
                    <div id="customDropdown">
                        <select id="categorySelect">
                            <option value="nothing"></option>
                            <?php foreach ($genres as $genre): ?>
                                <option value="<?php echo htmlspecialchars($genre); ?>">
                                    <?php echo htmlspecialchars(ucfirst($genre)); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div id="dropdownArrow"></div>
                    </div>
                </div>



            </div>
        </div>

        <div id="movieContainer">
            <?php
            $movieLimit = 12;
            foreach ($moviedata as $index => $movie) {
                if ($index >= $movieLimit)
                    break;
                $genres = implode(', ', array_map(function ($g) {
                    return strtolower($g["name"]);
                }, $movie["genres"]));
                ?>
                <div class="movieColumn" data-genres="<?php echo htmlspecialchars($genres); ?>">
                    <img id="movieImage" src="<?= $movie["image"]; ?>">
                    <div style="padding: .75vw;">
                        <div class="movieTitleContainer">
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
                        </div>
                        <div id="releaseText"><?= $movie["release_date"]; ?></div>
                        <div id="description"><?= $movie['description']; ?></div>
                        <div id="ticketsButton">MEER INFO & TICKETS</div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <a href="./agenda" target="_blank" style="z-index: 1;text-decoration:none;">
            <div id="allFilmsButton">BEKIJK ALLE FILMS</div>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('categorySelect');
            const movieColumns = document.querySelectorAll('.movieColumn');

            categorySelect.addEventListener('change', function () {
                const selectedGenre = categorySelect.value.toLowerCase();

                movieColumns.forEach(function (column) {
                    const genres = column.getAttribute('data-genres').toLowerCase();
                    if (selectedGenre === 'nothing' || genres.includes(selectedGenre)) {
                        column.style.display = 'block'; // Show movie
                    } else {
                        column.style.display = 'none'; // Hide movie
                    }
                });
            });
        });
    </script>
</main>

<footer>
    <?php include 'core/footer.php'; ?>
</footer>