<?php include 'core/header.php'; ?>

<div class="parentContainer" style="margin-top:30vh;">
    <div id="imageContainer">
        <div id="opacityBox"></div>
    </div>
    <div id="welcomeBox">
        <h1 style="font-size:3em;">WELKOM BIJ ANNEXBIOS LEERDAM</h1>
        <p style="width:40vw;font-size:1.5em;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam, dolore
            facilis. Quisquam commodi veniam, eius fugit ab exercitationem labore eum sit ullam eos reiciendis vitae
            ipsum corrupti inventore rerum distinctio.</p>
        <div id="referButton">BEKIJK DE DRAAIENDE FILMS</div>
    </div>
    <div id="locationBox">
        <div id="informationBox">
            <div id="mapsImage">
                <div style="text-decoration:none; overflow:hidden;max-width:100%;width:35vw;height:35vh;">
                    <div id="display-google-map" style="height:100%; width:100%;max-width:100%;"><iframe
                            style="height:100%;width:100%;border:0;" frameborder="0"
                            src="https://www.google.com/maps/embed/v1/place?q=Techniekweg+6+Leerdam&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                    </div><a class="googl-ehtml" href="https://www.bootstrapskins.com/themes"
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
                    <p style="font-size: 20px;color:white;margin-block-start:0;margin-block-end:0;">BEREIKBAARHEID</p>
                    <p style="color:white;margin-block-start:0;margin-block-end:0;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia dolor quo at quisquam cupiditate est architecto, laboriosam temporibus alias necessitatibus!</p>
                </div>
            </div>
        </div>
        <img id="locationImage" src="./assets/img/locatie.png" style="height:63vh;margin-left:2vw;">
    </div>
</div>
<div class="parentContainer">
<div id="blackBackground"></div>
</div>

<?php include 'core/footer.php'; ?>