
const cards = document.querySelectorAll(".card")
//console.log(cards);
cards.forEach(addCardElements)

function addCardElements(card) {
  const value = card.dataset.value
  //const suit = card.dataset.suit
  
  const valueAsNumber = parseInt(value)
  if (isNaN(valueAsNumber)) {
    card.append(createPip())
    
  } else {
    for (let i = 0; i < valueAsNumber; i++) {
      card.append(createPip())
    }
  }

  card.append(createCornerNumber("top", value))
  card.append(createCornerNumber("bottom", value))
}

function createCornerNumber(position, value) {
  const corner = document.createElement("div")
  
  corner.textContent = value
  //console.log(corner);
  corner.classList.add("corner-number")
  corner.classList.add(position)
  return corner
}

function createPip() {
  const pip = document.createElement("div")
 // console.log(pip);
  pip.classList.add("pip")
  return pip
}



//highlight card by clicking it and remove by clicking it again
var elements = document.getElementsByClassName("card");

var myFunction = function(){  
 if(this.getAttribute("class") == "card") {
  this.setAttribute("class","clicked");
}else{
  var attribute = this.setAttribute("class","card"); 
}
};

for(var i=0;i<elements.length;i++){          
      elements[i].addEventListener('click',myFunction, false);      
      elements[i].addEventListener('dragstart',myFunction, false); //drag n drop
      elements[i].addEventListener('dragend',myFunction, false); //drag n drop                 
}


//PLAY CARDS
var  clickPlay = function(){
  const cardsToPlay = document.querySelectorAll(".clicked")
  const playedValue = document.getElementById("cardSelector").value;
  var bluffFlag = false;
  console.log(cardsToPlay)
  console.log(playedValue)
  
  cardsToPlay.forEach(function(cardToPlay){
    console.log(cardToPlay.getAttribute("data-value"))
    if(cardToPlay.getAttribute("data-value") != playedValue && cardToPlay.getAttribute("data-value") != "Joker"){
        bluffFlag = true;     
    }
    console.log(bluffFlag);
        const url =
        "http://localhost/PHP_REST_API/api/gametable/play_card";
        fetch(url,{
          method: "PUT",
          headers: {
            Accept: "application/json, text/plain, */*",
            "Content-type": "application/json",
          },
          body: JSON.stringify({ card_id:  cardToPlay.id,
                                burned: false,
                                ontable: true,
                                bluff: bluffFlag  }),
        })
          .then((res) => res.json())
          .then((data) => console.log(data));
        
        const urlToInsertOnCheckBluff =
        "http://localhost/PHP_REST_API/api/checkbluff/add_new";
        fetch(url,{
          method: "POST",
          headers: {
            Accept: "application/json, text/plain, */*",
            "Content-type": "application/json",
          },
          body: JSON.stringify({ card_id:  cardToPlay.id,
                                burned: false,
                                ontable: true,
                                bluff: bluffFlag  }),
        })
          .then((res) => res.json())
          .then((data) => console.log(data));
    bluffFlag = false;
  }) 
  // jQuery(".clicked").attr('class','back_card');
} 
  callBluff = function(){
    const url =
    "http://localhost/PHP_REST_API/api/gametable/play_card";
  }
  
 

  /*
  jQuery(".clicked").attr('id','playedCard').css({
    "posistion":"absolute",
    "bottom":"200px",
    "--width": "5em",
    "--height": "calc(var(--width) * 1.4)",
    "width":" var(--width)",
    " height":" var(--height)",
    "background-color": "white",
    "border": "1px solid black",
    "border-radius": ".25em",
    "padding": "1em",
    "display": "grid",
    "grid-template-columns": "repeat(3, 1fr)",
    "grid-template-rows": "repeat(8, 1fr)",
    "align-items": "center",
    "position": "absolute",
  
} 


//TAKE CARDS BACK TO YOUR HAND
var clickTakeBack = function(){
  jQuery(".back_card").attr('class','card');
  //jQuery("#playedCard").removeAttr('id').css({"position":"relative","bottom":"-300px","background-image":"none"});
}

//END TURN, not final
var endTurn = function(){
  jQuery(".back_card").attr('class','back_card_burned');
  //const cards = document.getElementsByClassName(".black_card");
  //console.log(cards);
}











//drag n drop begins
document.addEventListener('DOMContentLoaded', (event) => {
var dragSrcEl = null;

function handleDragStart(e) {
  this.style.opacity = '0.4';

  
  dragSrcEl = this;

  e.dataTransfer.effectAllowed = 'move';
 // e.dataTransfer.setData('text/html', this.innerHTML)
}

function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault();
  }

  e.dataTransfer.dropEffect = 'move';
  
  return false;
}
function handleDragEnter(e) {
  this.classList.add('over');
}

function handleDragLeave(e) {
  this.classList.remove('over');
}
// function handleDrop(e) {
//   if (e.stopPropagation) {
//     e.stopPropagation(); // stops the browser from redirecting.
//   }
  
//   if (dragSrcEl != this) {
//     dragSrcEl.innerHTML = this.innerHTML;
//     this.innerHTML = e.dataTransfer.getData('text/html');
    
//   }
  
//   return false;
// }

function handleDragEnd(e) {
  this.style.opacity = '1';
  
  items.forEach(function (item) {
    item.classList.remove('over');
  });
}

let items = document.querySelectorAll('.card');
 items.forEach(function (item) {
  item.addEventListener('dragstart', handleDragStart);
  item.addEventListener('dragover', handleDragOver);
  item.addEventListener('dragenter', handleDragEnter);
  item.addEventListener('dragleave', handleDragLeave);
  item.addEventListener('dragend', handleDragEnd);
  //item.addEventListener('drop', handleDrop);
});
});
//drag n drops ends


*/











