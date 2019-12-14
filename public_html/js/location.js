if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(locationSuccess, locationError);
}
else{
    showError("Your browser does not support Geolocation!");
}
function locationSuccess (pos) {
    const lat = pos.coords.latitude;
    const lon = pos.coords.longitude;
    console.log({lat, lon});
}

function locationError(error) {
    console.log(error);
}
