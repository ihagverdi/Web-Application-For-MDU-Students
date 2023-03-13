var suggestionsList = document.getElementById('suggestions-list');
function search(inputString){
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
    suggestionsList.innerHTML = "";
    console.log("showing");
    if(data != null){
    for(let i = 0; i < data.length; i++){
        
        const anchor = document.createElement('a');
        anchor.innerHTML = data[i]['title'];
        anchor.href = "event-content.php?event_id="+data[i]['event_id'];
        anchor.style.color = "black";
        const li = document.createElement('li');
        li.appendChild(anchor);
        suggestionsList.appendChild(li);

        }
    }
    }
