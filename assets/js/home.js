window.addEventListener('scroll', function () {
    const scrollPosition = window.scrollY; // Get the number of pixels scrolled
    const imageContainer = document.getElementById("imageContainer");
    const threshold = 1100;

    if (scrollPosition > threshold) {
        const scrollOffset = scrollPosition - threshold;
        imageContainer.style.backgroundPosition = `center -${scrollOffset}px`;
    } else {
        imageContainer.style.backgroundPosition = `center 0px`;
    }
});
