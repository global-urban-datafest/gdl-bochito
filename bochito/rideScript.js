var ride;

function setRide(isRide) {
    if (isRide) {
        ride = isRide;
        console.log(ride)
    } else {
        ride = isRide;
        console.log(ride)
    }
}

function sendCord(pos, location) {
    var destlat, destlon, srclat, srclon;
    destlat = pos.k;
    destlon = pos.D;
    srclat = location.k;
    srclon = location.D;
    console.log(destlat);
    console.log(destlon);
    console.log(srclat);
    console.log(srclon);
}