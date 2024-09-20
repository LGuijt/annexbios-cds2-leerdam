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
            <?php
                // Collect unique genres
                $genres = array();
                foreach ($moviedata as $movie) {
                    foreach ($movie["genres"] as $genre) {
                        $genreName = strtolower($genre["name"]); // Convert genre name to lowercase for consistency
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
                                <?php echo htmlspecialchars(ucfirst($genre)); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div id="dropdownArrow"></div>
                </div>
            </div>

        </div>
    </div>

    <div id="movieContainer">
        <?php
        foreach ($moviedata as $index => $movie) {
            // Convert genres array to a comma-separated string
            $genres = implode(', ', array_map(function ($g) {
                return strtolower($g["name"]); }, $movie["genres"]));
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('categorySelect');
    const movieColumns = document.querySelectorAll('.movieColumn');

    categorySelect.addEventListener('change', function() {
        const selectedGenre = categorySelect.value.toLowerCase();

        movieColumns.forEach(function(column) {
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

<?php include 'core/footer.php'; ?>