require('./bootstrap');
let btnMoreCollection = document.querySelectorAll(".more-text");
btnMoreCollection.forEach(el => {
  if(el.previousElementSibling.clientHeight < 100) el.style.display = "none"
  el.addEventListener("click", showMoreText);
  
});

function showMoreText(event){
  if(event.target.innerHTML === "More"){
    event.target.innerHTML = "Less"
    event.target.previousElementSibling.style.maxHeight = "max-content";
  } else{
    event.target.innerHTML = "More"
    event.target.previousElementSibling.style.maxHeight = "100px";
  }
}
