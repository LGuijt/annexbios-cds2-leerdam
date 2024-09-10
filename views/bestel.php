<?php include 'core/header.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filmkeuze = $_POST['filmkeuze'];


    foreach ($moviedata as $movie) {
        if ($movie['api_id'] == $filmkeuze) {
            $filmnaam = $movie['title'];
            $image = $movie['image'];
            $releasedate = $movie['release_date'];
            $description = $movie['description'];
        }
    }

    foreach ($locationdata as $location) {
        if ($location['movie_id'] == $filmkeuze) {
            $playtime = $location['play_time'];
        }
    }
    $playtime = strtotime($playtime);
}
?>
<div id="bestelpagina">
    <form id="container">
        <div id="titel">TICKETS BESTELLEN</div>
        <div id="datumtijd">
            <div id="filmname"><?= $filmnaam ?></div>
            <select name="datum" id="datum">
                <option value="start">DATUM</option>
                <option value="<?= date("Y-m-d", $playtime); ?>"><?= date("d-m", $playtime) ?></option>
            </select>
            <select name="tijd" id="tijd">
                <option value="start">TIJD</option>
                <option value="<?= date("H:i:s", $playtime)?>"><?= date("H:i", $playtime)?></option>
            </select>
        </div>
        <div id="stappen">
            <div id="stapeen">
                <div class="staptitel">STAP 1: KIES JE TICKET</div>
                <div id="tickettabel">
                    <div id="prijstop">
                        <div>TYPE</div>
                        <div>PRIJS</div>
                        <div>AANTAL</div>
                    </div>
                    <div class="prijzen">
                        <div>Normaal</div>
                        <div>€9,00</div>
                        <select name="prijsnormaal" id="normalTickets">
                            <?php
                            for ($i = 0; $i <= 10; $i++) {
                                ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="prijzen">
                        <div>Kind t/m 11 jaar</div>
                        <div>€5,00</div>
                        <select name="prijskind" id="childTickets">
                            <?php
                            for ($i = 0; $i <= 10; $i++) {
                                ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="prijzen">
                        <div>65+</div>
                        <div>€7,00</div>
                        <select name="seniortickets" id="seniorTickets">
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
                    <div id="toevoegen">TOEVOEGEN</div>
                </div>
            </div>
            <div id="staptwee">
                <div class="staptitel">STAP 2: KIES JE STOEL</div>
            </div>
            <div id="stapdrie">
                <div class="staptitel">STAP 3: CONTROLEER JE BESTELLING</div>
                <div id="controlebox">
                    <div id="controleposter"><img alt="plaatje van de film" src=<?= $image ?>></div>
                    <!-- image is 160x240 -->
                    <div id="controletitel"><span class="bold"><?= $filmnaam ?></span></div>
                    <div>Kijkwijzercontainer</div>
                    <div><span class="bold">Bioscoop:</span> Leerdam (zaal 2)</div>
                    <div><span class="bold">Wanneer: </span><span id="when"></span></div>
                    <div><span class="bold">Stoelen:</span> Rij ?, stoel ?</div>
                    <div><span class="bold">Tickets: </span><span id="alletickets"></span></div>
                    <div id="controletotaal"><span class="bold">Totaal <span id="totaltickets"></span> ticket(s):</span><span id="totalprice"></span> </div>
                </div>
            </div>
            <div id="stapvier">
                <div class="staptitel">STAP 4: Vul je gegevens</div>
                <div id="gegevens">
                    <input type="text" name="voornaam" placeholder="Voornaam" id="firstname"></p>
                    <input type="text" name="achternaam" placeholder="Achternaam" id="lastname"></>
                    <input type="text" name="email" placeholder="E-mailadres*" class="email" style="grid-row: 2;" id="emailone"></>
                    <input type="text" name="emailtoo" placeholder="E-mailadres*" class="email" style="grid-row: 3;" id="emailtwo"></>
                </div>
            </div>
            <div id="stapvijf">
                <div class="staptitel">STAP 5: KIES JE BETAALWIJZE</div>
                <div id="betaalwijze">
                    <input type="checkbox" name="betaalwijze" value="biosbon" id="biosbon"><img alt="bioscoopbon"
                        src="./assets/img/biosbon.png">
                    <input type="checkbox" name="betaalwijze" value="maestro" id="maestro"><img alt="maestro"
                        src="./assets/img/maestro.png">
                    <input type="checkbox" name="betaalwijze" value="ideal" id="ideal"><img alt="ideal"
                        src="./assets/img/ideal.png">
                </div>
                <div id="voorwaarden">
                    <input type="checkbox" name="voorwaarden" value="voorwaarden" id="terms">
                    <div>Ik ga akkoord met de <a href="#">algemene voorwaarden</a></div>
                </div>
            </div>
        </div>
        <div id="filminfo">
            <div><img id="infoimg" alt="filmposter" src=<?= $image ?>></div>
            <!-- 200x300 -->
            <div id="filmomschrijving">
                <div id="infotitel"><?= $filmnaam ?></div>
                <div id="inforatings"><?php
                            $filledStars = floor($movie["rating"] / 2);
                            $unfilledStars = 5 - $filledStars;
                            for ($k = 0; $k < $filledStars; $k++) { ?>
                                <img class="star" src="./assets/img/star_filled.png">
                            <?php }
                            for ($k = 0; $k < $unfilledStars; $k++) { ?>
                                <img class="star" src="./assets/img/star_unfilled.png">
                            <?php } ?></div>
                <div id="infodatum">Release: <?= $releasedate ?></div>
                <div id="infoomschrijving"><?= $description ?></div>
            </div>
        </div>
        <div id="bestelbutton">
            <input id="topayment" type="submit" value="AFREKENEN" disabled>
        </div>
    </form>
</div>

<?php include 'core/footer.php'; ?>