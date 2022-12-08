        document.getElementById('getText').addEventListener('click',getText);
        document.getElementById('getUsers').addEventListener('click',getUsers);
        document.getElementById('getCards').addEventListener('click',getCards);
        document.getElementById('addPlayer').addEventListener('click',addPlayer);
        document.getElementById('getplayername').addEventListener('click',GetPlayerWithName);
        
        function getText(){
            // fetch('test.txt')
            // .then(function(response){
            //     return response.text();
            // })
            // .then(function(data){ 
            //     console.log(data);
            //  }
            // )

            fetch('../test.txt')
            .then((res) => res.text())
            .then((data) => {document.getElementById('output').innerHTML = data})
            .catch((err) => {console.log(err)})

        }

        function getUsers(){
            // fetch('test.txt')
            // .then(function(response){
            //     return response.text();
            // })
            // .then(function(data){ 
            //     console.log(data);
            //  }
            // )

            fetch('../Users.json')
            .then((res) => res.json())
            .then((data) => {
                let output = '<h2>Users</h2>';
                data.forEach(function(user){
                 output += `
                 <ul>
                    <li>ID:${user.id}</li>
                    <li>Name:${user.name}</li>
                </ul>`;  
                });
                document.getElementById('output').innerHTML = output;
                // console.log(data);
            })
            .catch((err) => {console.log(err)})

        }

        function getCards(){
            fetch('test.txt')
            .then(function(response){
                return response.text();
            })
            .then(function(data){ 
                console.log(data);
             }
            )
            const url = 'https://users.iee.ihu.gr/~it185186/ADISE22_GetBluffedHAHA/PHP_REST_API/api/card/read.php';
            // const url = 'http://localhost/PHP_REST_API/api/card/read.php';
            fetch(url)
            .then((res) => res.json())
            .then((data) => {
                let output = '<h2>cards</h2>';
                 data =  JSON.stringify(data.data);
                data = JSON.parse(data);
                console.log(data);
                data.forEach(function(card){
                 output += `
                 <div>
                    <h2>${card.id}</h2>
                    <h2>${card.colour}</h2>
                    <h2>${card.number}</h2>
                </div>`;  
                });
                document.getElementById('output').innerHTML = output;
            })
            .catch((err) => {console.log(err)})

        }
        function GetPlayerWithName(){
            

            let name = document.getElementById('name').value;
            const url = ('http://localhost/PHP_REST_API/api/player/get_player_with_name.php?' + new URLSearchParams({ name: name }).toString());
            console.log(url);
            if(name.length != 0 && name != ""){
                fetch(url)
                .then((res) => res.json())
                .then((data) => {
                let output = '<h2>player with name '+name+'</h2>';
                console.log(data.id);
                data =  JSON.stringify(data);
                data = JSON.parse(data);
                output += `
                 <div>
                    <h2>${data.id}</h2>
                    <h2>${data.name}</h2>
                    <h2>${data.created}</h2>
                </div>`;  
                // data.forEach(function(player){
                 
                // });
                document.getElementById('outputplayer').innerHTML = output;
            })
            .catch((err) => {console.log(err)})
            }else{
                alert('provide with name')
            }
            
        }
        function addPlayer(e){
            e.preventDefault();

            let name = document.getElementById('playername').value;
            const url = 'https://users.it.teithe.gr/PHP_REST_API/api/player/add_new_player.php';
            // const url = 'http://localhost/PHP_REST_API/api/player/add_new_player.php';
            if(name.length != 0 && name != ""){
                fetch(url, {
                method:'POST',
                headers: {
                'Accept': 'application/json, text/plain, */*',
                'Content-type':'application/json'
                },
                body:JSON.stringify({name:name})
                })
                .then((res) => res.json())
                .then((data) => console.log(data))
            }else{
                alert('provide with name')
            }
            
        }