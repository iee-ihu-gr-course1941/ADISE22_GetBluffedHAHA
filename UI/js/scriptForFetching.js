document.getElementById("get-cards-button").addEventListener("click", getCards);
setInterval(GetGameStatus, 1000);

function getCards() {
  const gameIdDiv = document.createElement("div");
  document.body.appendChild(gameIdDiv);
  gameIdDiv.id ="24";
  gameIdDiv.hidden = true;
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
            // document.body.appendChild(node);
            const box = document.getElementById("generated-cards-container");
            box.appendChild(node);
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
            // document.body.appendChild(node);
            const box = document.getElementById("generated-cards-container");
            box.appendChild(node);
          }
        } else {
          const node = document.createElement("div");
          node.setAttribute("id", card.id);
          node.setAttribute("class", "card");
          node.setAttribute("data-value", "Joker");
          // document.body.appendChild(node);
          const box = document.getElementById("generated-cards-container");
            box.appendChild(node);
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
  console.log(cards);
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

var elements = document.getElementsByClassName("card");

var myFunction = function(){  
  if(this.getAttribute("class") == "card") {
      this.setAttribute("class","clicked");
  }else{
      var attribute = this.setAttribute("class","card"); 
  }
};
function attachHighlight() {
  for(var i=0;i<elements.length;i++){          
        elements[i].addEventListener('click',myFunction, false);      
        elements[i].addEventListener('dragstart',myFunction, false); //drag n drop
        elements[i].addEventListener('dragend',myFunction, false); //drag n drop                 
  }
}
// function GetPlayerWithName() {
//   let name = document.getElementById("name").value;
//   const url =
//     "http://localhost/PHP_REST_API/api/player/get_player_with_name.php?" +
//     new URLSearchParams({ name: name }).toString();
//   console.log(url);
//   if (name.length != 0 && name != "") {
//     fetch(url)
//       .then((res) => res.json())
//       .then((data) => {
//         let output = "<h2>player with name " + name + "</h2>";
//         console.log(data.id);
//         data = JSON.stringify(data);
//         data = JSON.parse(data);
//         output += `
//             <div>
//             <h2>${data.id}</h2>
//             <h2>${data.name}</h2>
//             <h2>${data.created}</h2>
//         </div>`;
//         // data.forEach(function(player){

//         // });
//         document.getElementById("outputplayer").innerHTML = output;
//       })
//       .catch((err) => {
//         console.log(err);
//       });
//   } else {
//     alert("provide with name");
//   }
// }
var me={token:null};
function addPlayer() {

    if($('#username').val()=='') {
      alert('You have to set a username');
      return;
    }
    var p_color = $('#pcolor').val();
    draw_empty_board(p_color);
    fill_board();
    
    $.ajax({url: "http://localhost/PHP_REST_API/api/player/add_new_player.php", 
        method: 'POST',
        dataType: "json",
        headers: {"X-Token": me.token},
        contentType: 'application/json',
        data: JSON.stringify( {name: "alex"}),
        success: login_result,
        error: login_error});
  
  // // e.preventDefault();
  // let token = 1231241241241;
  // let name = "alex123";
  // if (name.length != 0 && name != "") {
  //   fetch("http://localhost/PHP_REST_API/api/player/add_new_player.php", {
  //     method: "POST",
  //     headers: {
  //       Accept: "application/json, text/plain, */*",
  //       "Content-type": "application/json",
  //       'X-Token': token
  //     },
  //     body: JSON.stringify({ name: name }),
  //   })
  //     .then((res) => res.json())
  //     .then((data) => console.log(data));
  // } else {
  //   alert("provide with name");
  // }
}

// function login_result(data) {
// 	me = data[0];
// }


//PLAY CARDS
var  clickPlay = function(){
  //adeiasma tou pinaka checkbluff gia na gemisei me thn kainourgia paiksia
  emptyCheckBluffTable()
  const cardsToPlay = document.querySelectorAll(".clicked")
  const playedValue = document.getElementById("cardSelector").value;
  var bluffFlag = false;
  console.log(cardsToPlay)
  console.log(playedValue)
  
  cardsToPlay.forEach(function(cardToPlay){
      // console.log(currentPlayer);
      console.log(cardToPlay.getAttribute("data-value"))
      if(cardToPlay.getAttribute("data-value") != playedValue && cardToPlay.getAttribute("data-value") != "Joker"){
          bluffFlag = true;     
      }
      console.log(bluffFlag);
          const url =
          "http://localhost/PHP_REST_API/api/gametable/play_card.php";
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
            console.log("current card id"+cardToPlay.id);
          insertOnCheckBluff(cardToPlay.id)

          // const urlToInsertOnCheckBluff =
          // "http://localhost/PHP_REST_API/api/checkbluff/add_new_check.php";
          // fetch(urlToInsertOnCheckBluff,{
          //   method: "POST",
          //   headers: {
          //     Accept: "application/json, text/plain, */*",
          //     "Content-type": "application/json",
          //   },
          //   body: JSON.stringify({ 
          //                         player_id:playerId,
          //                         card_id: cardToPlay.id }),
          // })
          //   .then((res) => res.json())
          //   .then((data) => console.log(data));
      bluffFlag = false;
  }) 
  // location.reload();
  // getCards();
  // jQuery(".clicked").attr('class','back_card');
}

function getCurrentPlayerId(){
  const url ="http://localhost/PHP_REST_API/api/gamecondition/get_current_player.php";
  fetch(url)
  .then((res) => res.json())
  .then((data) => {
      data =  JSON.stringify(data.data);
      data = JSON.parse(data);
      return data;
  })
  .catch(error => console.log('error', error));
  return null;
}

function callBluff(){
    const url ="http://localhost/PHP_REST_API/api/gametable/get_last_played_cards.php";

    fetch(url)
    .then((res) => res.json())
    .then((data) => {
        data =  JSON.stringify(data.data);
        data = JSON.parse(data);
        flag = false;
        data.forEach(function(cardPlayed){ 
            if (cardPlayed.bluff==true) {
              flag = true;
              alert('break loop')
            }    
        });
        if(flag){
          console.log("this " +data[0].player_id)
          giveCardsToTheRightPlayer(data[0].player_id)
        }else{
          giveCardsToTheRightPlayer(currentPlayerId)
        }
        emptyCheckBluffTable()
    })
    .catch(error => console.log('error', error));
  }

  
  function giveCardsToTheRightPlayer(playerId){
      const urlToRaiseCardsFromTable = "http://localhost/PHP_REST_API/api/gametable/raise_cards_from_table_after_bluff.php"
      fetch(urlToRaiseCardsFromTable,{
        method: "PUT",
        headers: {
          Accept: "application/json, text/plain, */*",
          "Content-type": "application/json",
        },
        body: JSON.stringify({player_id: playerId,
                              burned: false,
                              ontable: false,
                              bluff: false }),
      })
  }

  
  function emptyCheckBluffTable() {
    const url = "http://localhost/PHP_REST_API/api/checkbluff/empty_check_bluff.php"
    fetch(url,{
      method: "DELETE",
      headers: {
        Accept: "application/json, text/plain, */*",
        "Content-type": "application/json",
      }
    })
  }
  //card shuffling and distribution
  function itterateThroughPlayers() {
    const urlForPlayers = 'http://localhost/PHP_REST_API/api/player/read.php';
    let playerData = [];
    const playerDataResponse = fetch(urlForPlayers)
    .then(response => response.json())
    .then((data) => {
        data =  JSON.stringify(data.data);
        data = JSON.parse(data);
        const cardIds = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54]
        shuffle(cardIds)
        console.log(cardIds)
        var cardsOnTable =0;
        data.forEach(function(player){ 
            if (player.name.length!=0 && cardsOnTable<=54) {
                for(var i=0;i<18;i++){
                    // console.log(cardIds.shift())
                    console.log(cardIds)
                    console.log("player and card counter "+cardIds.length);
                    distributeCardsToPlayers(player.id,cardIds.shift())
                    cardsOnTable++;
                }
            }else{
              window.alert("all cards were distributed to players");
            }

            
            
        });


    })
    .catch(error => console.log('error', error));


    //check if button will be disabled
    const url="http://localhost/PHP_REST_API/api/checkbluff/check_if_empty_check_bluff.php";
    fetch(url)
    .then((res) => res.json())    
    .then((data) => {
      console.log("panw");
      console.log(data);
      console.log("kato");
	  if(data==null){
      document.getElementById("callBluff").disabled = true;
      console.log("disabled");  
	  }
    else{
      console.log("NOT disabled");	
    }
      })

}

  


function distributeCardsToPlayers(playerId,cardId) {
    fetch('http://localhost/PHP_REST_API/api/gametable/add_card.php', {
                method:'POST',
                headers: {
                'Accept': 'application/json, text/plain, */*',
                'Content-type':'application/json'
                },
                body:JSON.stringify({player_id:playerId,
                                    game_condition_id:11,
                                    card_id:cardId,
                                    burned:false
                })
                })
                .then((res) => res.json())
                .then((data) => console.log(data))
    
}

function shuffle(array) {
    let currentIndex = array.length,  randomIndex;

    // While there remain elements to shuffle.
    while (currentIndex != 0) {

        // Pick a remaining element.
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex--;

        // And swap it with the current element.
        [array[currentIndex], array[randomIndex]] = [
        array[randomIndex], array[currentIndex]];
    }

    return array;
}

function GetGameStatus(){

}

function insertOnCheckBluff(cardId){
  const url ="http://localhost/PHP_REST_API/api/gamecondition/get_current_game_condition.php?"+
  new URLSearchParams({ id: 11 });

      fetch(url)
      .then((res) => res.json())
      .then((data) => {
        
        data = JSON.stringify(data);
        data = JSON.parse(data);
        console.log(data.p_turn);
        const urlToInsertOnCheckBluff =
          "http://localhost/PHP_REST_API/api/checkbluff/add_new_check.php";
          fetch(urlToInsertOnCheckBluff,{
            method: "POST",
            headers: {
              Accept: "application/json, text/plain, */*",
              "Content-type": "application/json",
            },
            body: JSON.stringify({ 
                                  player_id:data.p_turn,
                                  card_id: cardId }),
          })
            .then((res) => res.json())
            .then((data) => console.log(data));
      })
      .catch((err) => {
        console.log(err);
  })
}
