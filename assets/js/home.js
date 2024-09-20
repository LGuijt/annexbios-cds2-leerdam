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

    let films = document.getElementById("filmsBoxImage");
    let thisWeek = document.getElementById("thisWeekBoxImage");
    let today = document.getElementById("todayBoxImage");
    let category = document.getElementById("categoryBoxImage");

    let filmsCheck = false;
    let thisWeekCheck = false;
    let todayCheck = false;
    let categoryCheck = false;

    films.addEventListener("click", () => {
        if(filmsCheck == false){
            filmsCheck = true;
            films.src = "./assets/img/checked.png";
        } else if (filmsCheck == true) {
            filmsCheck = false;
            films.src = "./assets/img/unchecked.png";
    }
});

thisWeek.addEventListener("click", () => {
    if(thisWeekCheck == false){
        thisWeekCheck = true;
        thisWeek.src = "./assets/img/checked.png";
    } else if (thisWeekCheck == true) {
        thisWeekCheck = false;
        thisWeek.src = "./assets/img/unchecked.png";
}
});

today.addEventListener("click", () => {
    if(todayCheck == false){
        todayCheck = true;
        today.src = "./assets/img/checked.png";
    } else if (todayCheck == true) {
        todayCheck = false;
        today.src = "./assets/img/unchecked.png";
}
});

category.addEventListener("click", () => {
    if(categoryCheck == false){
        categoryCheck = true;
        category.src = "./assets/img/checked.png";
    } else if (categoryCheck == true) {
        categoryCheck = false;
        category.src = "./assets/img/unchecked.png";
}
});


