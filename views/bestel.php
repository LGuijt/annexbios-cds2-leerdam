<?php include 'core/header.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filmchoice = $_POST['filmchoice'];

    foreach ($moviedata as $movie) {
        if ($movie['api_id'] == $filmchoice) {
            $filmname = $movie['title'];
            $image = $movie['image'];
            $releasedate = $movie['release_date'];
            $description = $movie['description'];
            $kijkwijzers = $movie['viewing_guides']["symbols"];
        }
    }

    for ($i = 0; $i < count($locationdata); $i++) {
        if ($locationdata[$i]['movie_id'] == $filmchoice) {
            $playtime = $locationdata[$i]['play_time'];
            $chairs = $locationdata[$i]['place_data'];
            $locationId = $locationdata[$i]['location_movie_id'];
        }
    }

    $playtime = strtotime($playtime);
}
?>
<div id="o-parentcontainer">
    <form id="container" method="post" action="./api/seats/seatreservation.php">
        <div id="title">TICKETS BESTELLEN</div>
        <div id="datetime">
            <div id="filmname"><?= $filmname ?></div>
            <select name="date" id="o-date">
                <option value="start">DATUM</option>
                <option value="<?= date("Y-m-d", $playtime); ?>"><?= date("d-m", $playtime) ?></option>
            </select>
            <select name="time" id="o-time">
                <option value="start">TIJD</option>
                <option value="<?= date("H:i:s", $playtime) ?>"><?= date("H:i", $playtime) ?></option>
            </select>
        </div>
        <div id="steps">
            <div id="step1">
                <div class="steptitle">STAP 1: KIES JE TICKET</div>
                <div id="tickettable">
                    <div id="pricetop">
                        <div>TYPE</div>
                        <div>PRIJS</div>
                        <div>AANTAL</div>
                    </div>
                    <div class="prices">
                        <div>Normaal</div>
                        <div>€9,00</div>
                        <select name="pricenormal" id="normalTickets">
                            <?php
                            for ($i = 0; $i <= 10; $i++) {
                                ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="prices">
                        <div>Kind t/m 11 jaar</div>
                        <div>€5,00</div>
                        <select name="pricechild" id="childTickets">
                            <?php
                            for ($i = 0; $i <= 10; $i++) {
                                ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="prices">
                        <div>65+</div>
                        <div>€7,00</div>
                        <select name="pricesenior" id="seniorTickets">
                            <?php
                            for ($i = 0; $i <= 10; $i++) {
                                ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div id="voucher">
                    <div>VOUCHERCODE</div>
                    <input type="text" name="voucher" placeholder="code" id="vouchercode">
                    <div id="addvoucher">TOEVOEGEN</div>
                </div>
            </div>
            <div id="step2">
                <div class="steptitle">STAP 2: KIES JE STOEL</div>
                <div id="placecontainer">
                    <?php
                    // var_dump($chairs);
                    ?>
                    <img id="screen" src="./assets/img/filmdoek.png">
                    <div id="seatscontainer">
                        <?php
                        foreach ($chairs as $chair) {
                            if ($chair['available'] == true) {
                                ?>
                                <label class="seat">
                                    <input type="checkbox" id="seat<?= $chair['place'] ?>" name="seat[]" class="seatsinput"
                                        value="<?= $chair['place'] ?>" onchange="seatChooser(<?= $chair['place'] ?>)">
                                    <img id="seatimg<?= $chair['place'] ?>" src="./assets/img/seatfree.png">
                                </label>
                                <?php
                            } else {
                                ?>
                                <label class="seat">
                                    <input type="checkbox" name="taken" value="taken" disabled>
                                    <img src="./assets/img/seattaken.png">
                                </label>

                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div id="legendcontainer">
                        <div id="legendfree" class="legenditem">
                            <p>Vrij</p>
                        </div>
                        <div id="legendtaken" class="legenditem">
                            <p>Bezet</p>
                        </div>
                        <div id="legendselected" class="legenditem">
                            <p>Jouw Selectie</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step3">
                <div class="steptitle">STAP 3: CONTROLEER JE BESTELLING</div>
                <div id="controlbox">
                    <div id="controlposter"><img alt="plaatje van de film" src=<?= $image ?>></div>
                    <!-- image is 160x240 -->
                    <div id="controltitle"><span class="bold"><?= $filmname ?></span></div>
                    <div>
                        <?php
                        for ($i = 0; $i < count($kijkwijzers); $i++) {
                            ?>
                            <img class="kijkwijzer" src=<?= $kijkwijzers[$i]["image"] ?>>
                            <?php
                        }
                        ?>
                    </div>
                    <div><span class="bold">Bioscoop:</span> Leerdam (zaal 2)</div>
                    <div><span class="bold">Wanneer: </span><span id="when"></span></div>
                    <div id="boldchairs"><span class="bold">Stoelen:</span> <span id="rows"></span></div>
                    <div><span class="bold">Tickets: </span><span id="alltickets"></span></div>
                    <div id="controltotal"><span class="bold">Totaal <span id="totaltickets"></span>
                            ticket(s):</span><span id="totalprice"></span> </div>
                </div>
            </div>
            <div id="step4">
                <div class="steptitle">STAP 4: Vul je gegevens</div>
                <div id="userinfo">
                    <input type="text" name="firstname" placeholder="Voornaam" id="firstname"></p>
                    <input type="text" name="lastname" placeholder="Achternaam" id="lastname"></d>
                    <input type="text" name="email" placeholder="E-mailadres*" class="email" style="grid-row: 2;"
                        id="emailone"></d>
                    <input type="text" name="emailtwo" placeholder="E-mailadres*" class="email" style="grid-row: 3;"
                        id="emailtwo"></d>
                </div>
            </div>
            <div id="step5">
                <div class="steptitle">STAP 5: KIES JE BETAALWIJZE</div>
                <div id="paymethod">
                    <input type="checkbox" name="paymethod" value="biosbon" id="biosbon"><img alt="bioscoopbon"
                        src="./assets/img/biosbon.png">
                    <input type="checkbox" name="paymethod" value="maestro" id="maestro"><img alt="maestro"
                        src="./assets/img/maestro.png">
                    <input type="checkbox" name="paymethod" value="ideal" id="ideal"><img alt="ideal"
                        src="./assets/img/ideal.png">
                </div>
                <div id="conditions">
                    <input type="checkbox" name="terms" value="voorwaarden" id="terms">
                    <div>Ik ga akkoord met de <a href="#">algemene voorwaarden</a></div>
                </div>
            </div>
        </div>
        <div id="filminfo">
            <div><img id="infoimg" alt="filmposter" src=<?= $image ?>></div>
            <!-- 200x300 -->
            <div id="filmdescription">
                <div id="infotitel"><?= $filmname ?></div>
                <div id="inforatings"><?php
                $filledStars = floor($movie["rating"] / 2);
                $unfilledStars = 5 - $filledStars;
                for ($k = 0; $k < $filledStars; $k++) { ?>
                        <img class="star" src="./assets/img/star_filled.png">
                    <?php }
                for ($k = 0; $k < $unfilledStars; $k++) { ?>
                        <img class="star" src="./assets/img/star_unfilled.png">
                    <?php
                }
                ?>
                </div>
                <div id="infodate">Release: <?= $releasedate ?></div>
                <div id="infodescription"><?= $description ?></div>
            </div>
        </div>
        <input type="hidden" name="filmid" value="<?= $locationId ?>">
        <div id="orderbutton">
            <input id="topayment" type="submit" value="AFREKENEN" disabled>
        </div>
    </form>
</div>

<?php include 'core/footer.php'; ?>