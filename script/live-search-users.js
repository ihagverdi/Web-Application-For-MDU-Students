var suggestionsList = document.getElementById('suggestions-list');
var searchInput = document.getElementById("search_id");
function search(search_username){
    console.log(search_username);
    if(search_username.length != 0){
        fetchSearchInput(search_username);
    }
    else{
        suggestionsList.innerHTML = "";
        return;
    }
}

function fetchSearchInput(search_username){
    fetch('../live/live_search_users.php',{
        method: 'POST',
        body: new URLSearchParams('username='+search_username)
    })
    .then(res => res.json())
    .then(res => showSearchResults(res))
    .catch(e => console.log('error: '+ e))
}

function showSearchResults(data){
    suggestionsList.style.display = "block";
    suggestionsList.innerHTML = "";
    console.log("showing");
    if(data != null){
    for(let i = 0; i < data.length; i++){
            const li = document.createElement('li');
            let username = data[i]['username']
            //let id = data[i]['event_id']
            li.innerHTML = username;
            li.style.cursor = "pointer";
           // li.id = "list-item-"+id;
            li.addEventListener("click",function(){
                //console.log(this.innerText);
                searchInput.value = this.innerText;
                suggestionsList.style.display = "none";
            })
            suggestionsList.appendChild(li);
        }
    }
    else{
        return;
    }
    }

