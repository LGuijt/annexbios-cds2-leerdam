<?php include 'core/header.php'; ?>

<div id="bestelpagina">
    <form id="container">
        <div id="titel">TICKETS BESTELLEN</div>
        <div id="datumtijd">
            <div id="filmname">filmnaam</div>
            <select name="datum">
                <option>DATUM</option>
                <?php
                $startdate=strtotime("today");
                $enddate=strtotime("+14 days", $startdate);
                
                while ($startdate < $enddate) {
                    ?>
                    <option value="<?= date("Y-m-d", $startdate); ?>"><?= date("d-m", $startdate); ?></option>
                    <?php
                  $startdate = strtotime("+1 day", $startdate);
                }
                ?>
            </select>
            <select name="tijd">
                <option>TIJD</option>
                <option>12:00</option>
                <option>15:00</option>
                <option>18:00</option>
                <option>21:00</option>
            </select>
        </div>
        <div id="stappen">
            <div id="stapeen">
                <div>STAP 1: KIES JE TICKET</div>
                <div id="tickettabel">
                    <div id="prijstop">
                        <div>TYPE</div>
                        <div>PRIJS</div>
                        <div>AANTAL</div>
                    </div>
                    <div class="prijzen">
                        <div>Normaal</div>
                        <div>€9,00</div>
                        <select name="prijsnormaal">
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
                        <select name="prijskind">
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
                        <select name="prijs65">
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
                    <div>VOUCHERCODE <input type="text" name="voucher"> <button>TOEVOEGEN</button></div>
                </div>
            </div>
            <div id="staptwee">
                <div>STAP 2: KIES JE STOEL</div>
            </div>
            <div id="stapdrie">
                <div>STAP 3: CONTROLEER JE BESTELLING</div>
                <div id="controlebox">
                    <div><img alt="plaatje van de film"></div>
                    <div>filmnaam</div>
                    <div>Kijkwijzercontainer</div>
                    <div>Bioscoop: Leerdam zaal (?)</div>
                    <div>Wanneer: </div>
                    <div>Stoelen: Rij ?, stoel ?</div>
                    <div>Tickets:</div>
                    <div>Totaal ? ticket(s): </div>
                </div>
            </div>
            <div id="stapvier">
                <div>STAP 4: Vul je gegevens</div>
                <div id="gegevens">
                    <div placeholder="Voornaam"></div>
                    <div placeholder="Achternaam"></div>
                    <div placeholder="E-mailadres*"></div>
                    <div placeholder="E-mailadres*"></div>
                </div>
            </div>
            <div id="stapvijf">
                <div>STAP 5: KIES JE BETAALWIJZE</div>
                <div id="betaalwijze">
                    <input type="checkbox" name="betaalwijze" value="biosbon"><img alt="bioscoopbon" src="./assets/img/biosbon.png">
                    <input type="checkbox" name="betaalwijze" value="maestro"><img alt="maestro" src="./assets/img/maestro.png">
                    <input type="checkbox" name="betaalwijze" value="ideal"><img alt="ideal" src="./assets/img/ideal.png">
                </div>
            <input type="checkbox" name="voorwaarden" value="voorwaarden">Ik ga akkoord met de <a href="#">algemene voorwaarden</a>
            </div>
        </div>
        <div id="filminfo">
            <div><img alt="filmposter"></div>
            <div id="filmomschrijving">
                <div>filmnaam</div>
                <div>ratings</div>
                <div>releasedatum</div>
                <div>filmomschrijving</div>
            </div>
        </div>
        <div id="bestelbutton">
            <input type="submit" value="AFREKENEN">
        </div>
    </form>
</div>

<?php include 'core/footer.php'; ?>