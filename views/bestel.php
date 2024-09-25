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
<div id="oParentContainer">
    <form id="container" method="post" action="./api/seats/seatreservation.php">
        <div id="title">TICKETS BESTELLEN</div>
        <div id="dateTime">
            <div id="filmName"><?= $filmname ?></div>
            <select name="date" id="oDate">
                <option value="start">DATUM</option>
                <option value="<?= date("Y-m-d", $playtime); ?>"><?= date("d-m", $playtime) ?></option>
            </select>
            <select name="time" id="oTime">
                <option value="start">TIJD</option>
                <option value="<?= date("H:i:s", $playtime) ?>"><?= date("H:i", $playtime) ?></option>
            </select>
        </div>
        <div id="steps">
            <div id="step1">
                <div class="stepTitle">STAP 1: KIES JE TICKET</div>
                <div id="ticketTable">
                    <div id="priceTop">
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
                    <input type="text" name="voucher" placeholder="code" id="voucherCode">
                    <div id="addVoucher">TOEVOEGEN</div>
                </div>
            </div>
            <div id="step2">
                <div class="stepTitle">STAP 2: KIES JE STOEL</div>
                <div id="placeContainer">
                    <?php
                    // var_dump($chairs);
                    ?>
                    <img id="screen" src="./assets/img/filmdoek.png">
                    <div id="seatsContainer">
                        <?php
                        foreach ($chairs as $chair) {
                            if ($chair['available'] == true) {
                                ?>
                                <label class="seat">
                                    <input type="checkbox" id="seat<?= $chair['place'] ?>" name="seat[]" class="seatsInput"
                                        value="<?= $chair['place'] ?>" onchange="seatChooser(<?= $chair['place'] ?>)">
                                    <img id="seatImg<?= $chair['place'] ?>" src="./assets/img/seatfree.png">
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
                    <div id="legendContainer">
                        <div id="legendFree" class="legendItem">
                            <p>Vrij</p>
                        </div>
                        <div id="legendTaken" class="legendItem">
                            <p>Bezet</p>
                        </div>
                        <div id="legendSelected" class="legendItem">
                            <p>Jouw Selectie</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step3">
                <div class="stepTitle">STAP 3: CONTROLEER JE BESTELLING</div>
                <div id="controlBox">
                    <div id="controlPoster"><img alt="plaatje van de film" src=<?= $image ?>></div>
                    <!-- image is 160x240 -->
                    <div id="controlTitle"><span class="bold"><?= $filmname ?></span></div>
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
                    <div id="boldChairs"><span class="bold">Stoelen:</span> <span id="rows"></span></div>
                    <div><span class="bold">Tickets: </span><span id="allTickets"></span></div>
                    <div id="controlTotal"><span class="bold">Totaal <span id="totalTickets"></span>
                            ticket(s):</span><span id="totalPrice"></span> </div>
                </div>
            </div>
            <div id="step4">
                <div class="stepTitle">STAP 4: Vul je gegevens</div>
                <div id="userInfo">
                    <input type="text" name="firstname" placeholder="Voornaam" id="firstName"></p>
                    <input type="text" name="lastname" placeholder="Achternaam" id="lastName"></d>
                    <input type="text" name="email" placeholder="E-mailadres*" class="email" style="grid-row: 2;"
                        id="emailOne"></d>
                    <input type="text" name="emailtwo" placeholder="E-mailadres*" class="email" style="grid-row: 3;"
                        id="emailTwo"></d>
                </div>
            </div>
            <div id="step5">
                <div class="stepTitle">STAP 5: KIES JE BETAALWIJZE</div>
                <div id="payMethod">
                    <input type="checkbox" name="paymethod" value="biosbon" id="biosBon"><img alt="bioscoopbon"
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
        <div id="filmInfo">
            <div><img id="infoImg" alt="filmposter" src=<?= $image ?>></div>
            <!-- 200x300 -->
            <div id="filmDescription">
                <div id="infoTitel"><?= $filmname ?></div>
                <div id="infoRatings"><?php
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
                <div id="infoDate">Release: <?= $releasedate ?></div>
                <div id="infoDescription"><?= $description ?></div>
            </div>
        </div>
        <input type="hidden" name="filmid" value="<?= $locationId ?>">
        <div id="orderButton">
            <input id="toPayment" type="submit" value="AFREKENEN" disabled>
        </div>
    </form>
</div>

<?php include 'core/footer.php'; ?>