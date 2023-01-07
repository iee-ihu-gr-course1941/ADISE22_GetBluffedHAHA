var me={token:null};

function playerLogin() {
  let name = document.getElementById("playername").value;
	if (name.length != 0 && name != "") {
        fetch("http://localhost/PHP_REST_API/api/player/add_new_player.php", {
          method: "POST",
          headers: {
            Accept: "application/json, text/plain, */*",
            "Content-type": "application/json",
            "X-Token": { token : me.token }   
          },
          body: JSON.stringify({ name : name }),
        })
          .then((res) => res.json())
          .then((data) => console.log(data));

      } else {
        alert("provide with name");
    }
    // console.log(name);
    getAllPlayers();
    // getPlayerInfo(name);
}

function getAllPlayers() {
  const myRequest = new Request('http://localhost/PHP_REST_API/api/player/read.php', {
    method: 'GET',
    headers: {
      Accept: "application/json, text/plain, */*",
      "Content-type": "application/json",
      "X-Token": { token: me.token }   
    }
  });
  fetch(myRequest)
  .then((res) => res.json())
  .then((data) => {
      console.log(data.data[data.data.length - 1]);
      data = JSON.stringify(data);
      data = JSON.parse(data);
      // console.log(data);
  })
}

function getPlayerInfo(name) {
    const url =
    "http://localhost/PHP_REST_API/api/player/get_player_with_name.php?" +
    new URLSearchParams({ name: name }).toString();
    console.log(name);
    console.log(url);
    fetch(url)
    .then((res) => res.json())
    .then((data) => {
        console.log(data);
        data = JSON.stringify(data);
        data = JSON.parse(data);
})
}