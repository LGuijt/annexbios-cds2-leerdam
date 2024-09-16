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
        }
    }

    $lurl = 'https://annexbios.nickvz.nl/api/v1/playingMovies/' . $filmchoice;

// Initialize cURL session
$lch = curl_init($lurl);

// Set cURL options
curl_setopt($lch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
curl_setopt($lch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($lch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($lch, CURLOPT_FOLLOWLOCATION, true);

// Execute cURL request
$locationresult = curl_exec($lch);

// Check for cURL errors
if ($locationresult === false) {
    echo 'cURL Error: ' . curl_error($lch);
}

// Close cURL session
curl_close($lch);


// var_dump($result);
$locationres = json_decode($locationresult, true);
// var_dump($res['data']);
$locationdata = $locationres['data'][0];

$playtime = strtotime($locationdata["play_time"]);
}
?>
<div id="o-parentcontainer">
    <form id="container">
        <div id="title">TICKETS BESTELLEN</div>
        <div id="datetime">
            <div id="filmname"><?= $filmname ?></div>
            <select name="date" id="o-date">
                <option value="start">DATUM</option>
                <option value="<?= date("Y-m-d", $playtime); ?>"><?= date("d-m", $playtime) ?></option>
            </select>
            <select name="time" id="o-time">
                <option value="start">TIJD</option>
                <option value="<?= date("H:i:s", $playtime)?>"><?= date("H:i", $playtime)?></option>
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
            </div>
            <div id="step3">
                <div class="steptitle">STAP 3: CONTROLEER JE BESTELLING</div>
                <div id="controlbox">
                    <div id="controlposter"><img alt="plaatje van de film" src=<?= $image ?>></div>
                    <!-- image is 160x240 -->
                    <div id="controltitle"><span class="bold"><?= $filmname ?></span></div>
                    <div>Kijkwijzercontainer</div>
                    <div><span class="bold">Bioscoop:</span> Leerdam (zaal 2)</div>
                    <div><span class="bold">Wanneer: </span><span id="when"></span></div>
                    <div><span class="bold">Stoelen:</span> Rij ?, stoel ?</div>
                    <div><span class="bold">Tickets: </span><span id="alltickets"></span></div>
                    <div id="controltotal"><span class="bold">Totaal <span id="totaltickets"></span> ticket(s):</span><span id="totalprice"></span> </div>
                </div>
            </div>
            <div id="step4">
                <div class="steptitle">STAP 4: Vul je gegevens</div>
                <div id="userinfo">
                    <input type="text" name="firstname" placeholder="Voornaam" id="firstname"></p>
                    <input type="text" name="lastname" placeholder="Achternaam" id="lastname"></>
                    <input type="text" name="email" placeholder="E-mailadres*" class="email" style="grid-row: 2;" id="emailone"></>
                    <input type="text" name="emailtwo" placeholder="E-mailadres*" class="email" style="grid-row: 3;" id="emailtwo"></>
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
                            <?php } ?></div>
                <div id="infodate">Release: <?= $releasedate ?></div>
                <div id="infodescription"><?= $description ?></div>
            </div>
        </div>
        <div id="orderbutton">
            <input id="topayment" type="submit" value="AFREKENEN" disabled>
        </div>
    </form>
</div>

<?php include 'core/footer.php'; ?>