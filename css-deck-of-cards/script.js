
const cards = document.querySelectorAll(".card")
console.log(cards);
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
  //console.log("clicked me");
}else{
  var attribute = this.setAttribute("class","card"); 
}
};

for(var i=0;i<elements.length;i++){     
      elements[i].addEventListener('click',myFunction, false); 
      elements[i].addEventListener('dragstart',myFunction, false); //drag n drop
      elements[i].addEventListener('dragend',myFunction, false); //drag n drop
      
            
}


//play cards
var  clickFun=function(){
 // if(this.getAttribute("class") == "clicked"){
  if(this.getAttribute("clicked")){

    this.setAttribute("class","card-in-stack");
    console.log("clicked me1");
  }else{
    console.log("clicked me2");
  }
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














