<?php include 'core/header.php'; ?>

<div id="parentContainer" style="margin-top:30vh;">
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
                <div style="text-decoration:none; overflow:hidden;max-width:100%;width:40vw;height:40vh;">
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
            <div id="information"></div>
        </div>
        <div id="locationImage"></div>
    </div>
</div>

<?php include 'core/footer.php'; ?>