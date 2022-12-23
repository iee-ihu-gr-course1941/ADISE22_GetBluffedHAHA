
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
}else{
  var attribute = this.setAttribute("class","card"); 
}
};


for(var i=0;i<elements.length;i++){     
      elements[i].addEventListener('click',myFunction, false);           
}













