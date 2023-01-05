// document.getElementById('getText').addEventListener('click',getText);
// document.getElementById('getUsers').addEventListener('click',getUsers);
document.getElementById("getCards").addEventListener("click", getCards);
// document.getElementById('addPlayer').addEventListener('click',addPlayer);
// document.getElementById('getplayername').addEventListener('click',GetPlayerWithName);

// function getText(){
//     // fetch('test.txt')
//     // .then(function(response){
//     //     return response.text();
//     // })
//     // .then(function(data){
//     //     console.log(data);
//     //  }
//     // )

//     fetch('../test.txt')
//     .then((res) => res.text())
//     .then((data) => {document.getElementById('output').innerHTML = data})
//     .catch((err) => {console.log(err)})

// }

// function getUsers(){
//     // fetch('test.txt')
//     // .then(function(response){
//     //     return response.text();
//     // })
//     // .then(function(data){
//     //     console.log(data);
//     //  }
//     // )

//     fetch('../Users.json')
//     .then((res) => res.json())
//     .then((data) => {
//         let output = '<h2>Users</h2>';
//         data.forEach(function(user){
//          output += `
//          <ul>
//             <li>ID:${user.id}</li>
//             <li>Name:${user.name}</li>
//         </ul>`;
//         });
//         document.getElementById('output').innerHTML = output;
//         // console.log(data);
//     })
//     .catch((err) => {console.log(err)})

// }

function getCards() {
  let player_id = document.getElementById("player_id").value;
  // const url = 'https://users.iee.ihu.gr/~it185186/ADISE22_GetBluffedHAHA/PHP_REST_API/api/card/read.php';
  // const url = 'http://localhost/PHP_REST_API/api/card/read.php';
  const url =
    "http://localhost/PHP_REST_API/api/gametable/get_player_hand.php?" +
    new URLSearchParams({ player_id }).toString();
  console.log(url);
  fetch(url)
    .then((res) => res.json())
    .then((data) => {
      let output = "<h2>cards</h2>";
      data = JSON.stringify(data.data);
      data = JSON.parse(data);
      console.log(data);
      data.forEach(function (card) {
        if (card.number != "JOKER1" && card.number != "JOKER2") {
          if (card.number != "10") {
            card.colour = card.colour.toLowerCase();
            card.number = card.number.charAt(0);
            const node = document.createElement("div");
            node.setAttribute("id", card.id);
            node.setAttribute("class", "card");
            node.setAttribute("data-suit", card.colour);
            node.setAttribute("data-value", card.number);
            if (card.colour != "clover") {
              node.setAttribute("data-suit", card.colour);
            } else {
              node.setAttribute("data-suit", "club");
            }
            document.body.appendChild(node);
            // const box = document.getElementById("output");
            // box.appendChild(node);
          } else {
            card.colour = card.colour.toLowerCase();
            const node = document.createElement("div");
            node.setAttribute("id", card.id);
            node.setAttribute("class", "card");
            node.setAttribute("data-suit", card.colour);
            node.setAttribute("data-value", card.number);
            if (card.colour != "clover") {
              node.setAttribute("data-suit", card.colour);
            } else {
              node.setAttribute("data-suit", "club");
            }
            document.body.appendChild(node);
            // const box = document.getElementById("output");
            // box.appendChild(node);
          }
        } else {
          const node = document.createElement("div");
          node.setAttribute("id", card.id);
          node.setAttribute("class", "card");
          node.setAttribute("data-value", "Joker");
          document.body.appendChild(node);
          // const box = document.getElementById("output");
          // box.appendChild(node);
        }
      });
      console.log(document.body.childNodes);
      addStyles();
      attachHighlight();
      // document.getElementById('output').innerHTML = output;
    })
    .catch((err) => {
      console.log(err);
    });
}

function addStyles() {
  const cards = document.querySelectorAll(".card");
  cards.forEach(addCardElements);
}

function addCardElements(card) {
  const value = card.dataset.value;
  // const suit = card.dataset.suit

  const valueAsNumber = parseInt(value);
  if (isNaN(valueAsNumber)) {
    card.append(createPip());
  } else {
    for (let i = 0; i < valueAsNumber; i++) {
      card.append(createPip());
    }
  }

  card.append(createCornerNumber("top", value));
  card.append(createCornerNumber("bottom", value));
}

function createCornerNumber(position, value) {
  const corner = document.createElement("div");
  corner.textContent = value;
  corner.classList.add("corner-number");
  corner.classList.add(position);
  return corner;
}

function createPip() {
  const pip = document.createElement("div");
  pip.classList.add("pip");
  return pip;
}
function GetPlayerWithName() {
  let name = document.getElementById("name").value;
  const url =
    "http://localhost/PHP_REST_API/api/player/get_player_with_name.php?" +
    new URLSearchParams({ name: name }).toString();
  console.log(url);
  if (name.length != 0 && name != "") {
    fetch(url)
      .then((res) => res.json())
      .then((data) => {
        let output = "<h2>player with name " + name + "</h2>";
        console.log(data.id);
        data = JSON.stringify(data);
        data = JSON.parse(data);
        output += `
            <div>
            <h2>${data.id}</h2>
            <h2>${data.name}</h2>
            <h2>${data.created}</h2>
        </div>`;
        // data.forEach(function(player){

        // });
        document.getElementById("outputplayer").innerHTML = output;
      })
      .catch((err) => {
        console.log(err);
      });
  } else {
    alert("provide with name");
  }
}
function addPlayer(e) {
  e.preventDefault();

  let name = document.getElementById("playername").value;
  if (name.length != 0 && name != "") {
    fetch("http://localhost/PHP_REST_API/api/player/add_new_player.php", {
      method: "POST",
      headers: {
        Accept: "application/json, text/plain, */*",
        "Content-type": "application/json",
      },
      body: JSON.stringify({ name: name }),
    })
      .then((res) => res.json())
      .then((data) => console.log(data));
  } else {
    alert("provide with name");
  }
}

//highlight card by clicking it and remove by clicking it again
var elements = document.getElementsByClassName("card");

var myFunction = function () {
  if (this.getAttribute("class") == "card") {
    this.setAttribute("class", "clicked");
  } else {
    this.setAttribute("class", "card");
  }
};
function attachHighlight() {
  for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener("click", myFunction, false);
  }
}
