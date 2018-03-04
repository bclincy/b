const current = document.querySelector("#current");
const images = document.querySelectorAll(".imgs img");
const opacity = 0.6;

// Set first img opacity
images[0].style.opacity = opacity;

images.forEach(img => img.addEventListener("click", imgClick));

function imgClick(e) {
    current.classList.add("fadeOutRightBig");
    // Reset the opacity
    images.forEach(img => (img.style.opacity = 1));

    // Change current image to src of clicked image
    current.src = e.target.src;
    current.alt = e.target.alt;
    current.title = e.target.title;

    // Add fade in class

    current.classList.add("fadeInRightBig");

    // Remove fade-in class after .5 seconds
    setTimeout(() => current.classList.remove("fadeOutRightBig"), 500);
    setTimeout(() => current.classList.add("fadeInLeftBig"), 500);

    // Change the opacity to opacity var
    e.target.style.opacity = opacity;
}
