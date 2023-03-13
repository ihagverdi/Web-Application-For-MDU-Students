var xmlhttp;
function favoriteChecker(element,event_id,user_id){
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == 1){ //delete event from favs
                removeFromFavorite(event_id, user_id);
                element.src = '/media/icons8-heart-blank.png';
            }
            else{ //add event to favs
                addToFavorite(event_id, user_id);
                element.src = '/media/icons8-heart-filled.png';
            }
        }
    }
    xmlhttp.open("GET",'../api/users/getFavorite_single.php?event_id='+event_id+'&user_id='+user_id,true);
    xmlhttp.send();
}

function removeFromFavorite(event_id,user_id) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET",'../api/users/removeFavorite.php?event_id='+event_id+'&user_id='+user_id,true);
    xmlhttp.send();
}
function addToFavorite(event_id,user_id) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET",'../api/users/addFavorite.php?event_id='+event_id+'&user_id='+user_id,true);
    xmlhttp.send();
}
// ---------------------For Bookings---------------------------------

function reservationChecker(element,event_id,user_id){
    var seat_id = 'num-seats-'+event_id;
    var numSeats = document.getElementById(seat_id);
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == 1){ //delete event from reservation
                removeFromReservations(event_id,user_id);
                element.src = '/media/icons8-ticket-blank.png';
                numSeats.innerHTML++;
                
            }
            else{ //add event to reservations
                addToReservations(event_id,user_id);
                element.src = '/media/icons8-ticket.png';
                numSeats.innerHTML--;
               
            }
        }
    }
    xmlhttp.open("GET",'../api/users/getReservation_single.php?event_id='+event_id+'&user_id='+user_id,true);
    xmlhttp.send();
}

function removeFromReservations(event_id,user_id) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET",'../api/users/removeBooking.php?event_id='+event_id+'&user_id='+user_id,true);
    xmlhttp.send();
}
function addToReservations(event_id,user_id) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET",'../api/users/bookEvent.php?event_id='+event_id+'&user_id='+user_id,true);
    xmlhttp.send();
}
