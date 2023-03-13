var slideImage = document.getElementById('landscape-img');
var slideTitle = document.getElementById('landscape-title');
var slideLink = document.getElementById('landscape-link');
fetch("../api/events/fetchSlideshow.php")
.then(res => res.json())
.then(res => makeSlideShow(res))
.catch(e => console.log('error:'+e))

function makeSlideShow(data){
    let cnt = 0;
    slideImage.src = '../'+data[cnt]['image'];
    slideTitle.innerHTML = data[cnt]['title'];
    slideLink.href = 'event-content.php?event_id='+data[cnt]['event_id'];
    cnt++;
    setInterval(function(){
        slideImage.src = '../'+data[cnt]['image'];
        slideTitle.innerHTML = data[cnt]['title'];
        slideLink.href = 'event-content.php?event_id='+data[cnt]['event_id'];

        if(cnt < data.length - 1){
            cnt++
        }
        else{
            cnt = 0
        }
    },5000)
}




