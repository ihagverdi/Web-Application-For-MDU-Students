var dropDown = document.getElementById('dropDown-btn');
var category = ['trips', 'parties', 'sports', 'seminars', 'arts & culture', 'fikas'];
dropDown.onclick = function() {
    for (let i = 0; i < 6; i++)
    document.getElementById("category-filters-"+category[i]).classList.toggle("show");
    document.getElementById("dates").classList.toggle("show");
}