var suggestionsList = document.getElementById('suggestions-list');
var searchInput = document.getElementById("search_id");
function search(inputString){
    console.log(inputString);
    if(inputString.length != 0){
        fetchSearchInput(inputString);
    }
    else{
        suggestionsList.innerHTML = "";
        return;
    }
}

function fetchSearchInput(inputString){
    fetch('../live/live_search.php',{
        method: 'POST',
        body: new URLSearchParams('input='+inputString)
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
            let title = data[i]['title']
            //let id = data[i]['event_id']
            li.innerHTML = title;
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

