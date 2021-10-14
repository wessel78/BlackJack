<?php 
    session_start();
    if ($_SESSION['session-start'] != true) {
        header('Location: index.php');
        die();
    }

    require ('../assets/ajax/global_variable.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/scss/blackjack/blackjack.css">
    <title>Blackjack</title>
</head>
<body>
    <section class="main-wrapper">
        <div class="content-wrapper">
            <div class="player-title" style="margin-top: 100px">
                <h1>Dealer</h1>
            </div>
            <div id="dealer" class="dealer">
                <!-- <div class="dealer-card">

                </div>
                <div class="dealer-card">
                    
                </div> -->
            </div>

            <div class="player-title">
                    <h1>Player</h1>
                </div>
            <div id="player" class="player">
                <!-- <div class="player-card">
                    <img src="../assets/img/CARDS/card_ (11).png" alt="">
                </div>
                <div class="player-card">

                </div> -->
                <!-- <div class="player-card">

                </div>
                <div class="player-card">

                </div>
                <div class="player-card">

                </div> -->
            </div>

        </div>
    </section>

    <footer class="footer-wrapper">
            <div class="footer-content-wrapper">
                <div class="balance-wrapper">
                    <label for="total-balance">Ingezet</label>
                    <input type="number" min="0" value="<?php echo $_SESSION['current_bet_money'] ?>" name="total-balance" id="total-balance">
                </div>

                <div class="btn-wrapper">
                    <div id="hit" class="hit">
                        <p>Hit</p>
                    </div>

                    <div id="stand" class="stand">
                        <p>Stand</p>
                    </div>
                </div>
            </div>
        </footer>
</body>
</html>

<script>


    //Disable input fields
    const total_balance = document.getElementById('total-balance');

    total_balance.disabled = true;

    //Hit
    let amount_run = 0;
    const hit = document.getElementById('hit');
    hit.addEventListener('click', () => {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                calculatePlayerScore();
                console.log(player_score);
                console.log(xhr.responseText);
                getPlayerScore()
                if (player_score != 'player-lose' && xhr.responseText != "game-not-active") {
                    console.log(player_score);
                    displayCards("player", getCardImg(xhr.responseText));
                } 
                if (player_score == 'player-lose' && amount_run == 0 && xhr.responseText != "game-not-active") {
                    // console.log(1);
                    displayCards("player", getCardImg(xhr.responseText));
                    standFunction();
                    amount_run += 1
                }
            }
        };
        xhr.open("GET", "../assets/ajax/blackjack/get_player_cards.php", false);
        xhr.send();
    });

    //Stand
    const stand = document.getElementById('stand');
    let dealer_score;
    stand.addEventListener('click', () => {
        standFunction();
    });

    function standFunction() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {            
                    dealer_score = calculateDealerScore();
                    displayCards("dealer-hidden", getCardImg(xhr.responseText));

                    for (dealer_score; dealer_score < 17; dealer_score + dealer_score) {
                        getDealerCardStand();
                        dealer_score = calculateDealerScore();
                        // console.log(dealer_score)
                    }
                    calculateWinner();
                }
            };
            xhr.open("GET", "../assets/ajax/blackjack/show_hidden_dealer_card.php", false);
            xhr.send();
        }

    getPlayerScore();
    function getPlayerScore() {
        setTimeout(() => {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(xhr.responseText)
                    
                }
            };
        xhr.open("GET", "../assets/ajax/blackjack/get_player_score.php", false);
        xhr.send();
        }, 600);
    }

    // Calculate dealer score
    let return_value;
    function calculateDealerScore() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                return_value = xhr.responseText;
                // console.log(return_value);
            // console.log(xhr.responseText);
            //     if (xhr.responseText != 'higher-then-17') {
            //         displayCards("dealer", getCardImg(xhr.responseText));
            //     }
            }
        };
        xhr.open("GET", "../assets/ajax/blackjack/get_dealer_score.php", false);
        xhr.send();
        return return_value;
    }

    let blackjack_player;
    let blackjack_dealer;
    

    function calculateWinner() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xhr.responseText);
                if (xhr.responseText == "draw") {
                    console.log('draw');
                }
                if (xhr.responseText == "player-win") {
                    console.log('player-win');
                }
                if (xhr.responseText == 'dealer-win') {
                    console.log('dealer-win');
                }
                
            }
        };
        xhr.open("GET", "../assets/ajax/blackjack/calculate_winner.php", false);
        xhr.send();
    }

    checkBlackJackPlayer();
    function checkBlackJackPlayer() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                 if (xhr.responseText == "player-blackjack") {
                    // blackjack_player = true;
                    console.log('player-blackjack');
                }
            }
        };
        xhr.open("GET", "../assets/ajax/blackjack/calculate_blackjack.php", false);
        xhr.send();
    }

    let player_score;
    function calculatePlayerScore() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                player_score = xhr.responseText;
            }
        };
        xhr.open("GET", "../assets/ajax/blackjack/hit.php", false);
        xhr.send();
        return player_score;
    }

    //Get player cards
    function getPlayer(i) {
        if (i > 2) return;
        setTimeout(() => {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(xhr.responseText);
                    displayCards("player", getCardImg(xhr.responseText));
                }
            };
            xhr.open("POST", "../assets/ajax/blackjack/get_player_cards.php", false);
            xhr.send();

            getPlayer(i += 1);
        }, 200);
    }

    getPlayer(1);
    
    //Get dealer cards

    function getDealer(i) {
        // console.log(i);
        if (i > 2) return;
            setTimeout(() => {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // console.log(xhr.responseText);
                        if (xhr.responseText == 'hidden-card') {
                            displayCards("dealer_hash", xhr.responseText);
                        } else {
                            displayCards("dealer", getCardImg(xhr.responseText));
                        }
                    }
                };
                xhr.open("POST", "../assets/ajax/blackjack/get_dealer_cards.php", false);
                xhr.send();

                getDealer(i += 1);
            }, 200);
    }

    getDealer(1);

    function getDealerCardStand() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(xhr.responseText);
                displayCards("dealer", getCardImg(xhr.responseText));
            }
        };
        xhr.open("POST", "../assets/ajax/blackjack/get_dealer_cards.php", false);
        xhr.send();
    }

        function getCardImg(card) {
            let card_a = ['../assets/img/CARDS/card_ (1).png' , '../assets/img/CARDS/card_ (14).png', '../assets/img/CARDS/card_ (27).png', '../assets/img/CARDS/card_ (40).png'];
            let card_2 = ['../assets/img/CARDS/card_ (2).png', '../assets/img/CARDS/card_ (15).png' , '../assets/img/CARDS/card_ (28).png' , '../assets/img/CARDS/card_ (41).png'];
            let card_3 = ['../assets/img/CARDS/card_ (3).png', '../assets/img/CARDS/card_ (16).png' , '../assets/img/CARDS/card_ (29).png' , '../assets/img/CARDS/card_ (42).png'];
            let card_4 = ['../assets/img/CARDS/card_ (4).png', '../assets/img/CARDS/card_ (17).png' , '../assets/img/CARDS/card_ (30).png' , '../assets/img/CARDS/card_ (43).png'];
            let card_5 = ['../assets/img/CARDS/card_ (5).png', '../assets/img/CARDS/card_ (18).png' , '../assets/img/CARDS/card_ (31).png' , '../assets/img/CARDS/card_ (44).png'];
            let card_6 = ['../assets/img/CARDS/card_ (6).png', '../assets/img/CARDS/card_ (19).png' , '../assets/img/CARDS/card_ (32).png' , '../assets/img/CARDS/card_ (45).png'];
            let card_7 = ['../assets/img/CARDS/card_ (7).png', '../assets/img/CARDS/card_ (20).png' , '../assets/img/CARDS/card_ (33).png' , '../assets/img/CARDS/card_ (46).png'];
            let card_8 = ['../assets/img/CARDS/card_ (8).png', '../assets/img/CARDS/card_ (21).png' , '../assets/img/CARDS/card_ (34).png' , '../assets/img/CARDS/card_ (47).png'];
            let card_9 = ['../assets/img/CARDS/card_ (9).png', '../assets/img/CARDS/card_ (22).png' , '../assets/img/CARDS/card_ (35).png' , '../assets/img/CARDS/card_ (48).png'];
            let card_10 = ['../assets/img/CARDS/card_ (10).png', '../assets/img/CARDS/card_ (23).png' , '../assets/img/CARDS/card_ (36).png' , '../assets/img/CARDS/card_ (49).png'];
            let card_j = ['../assets/img/CARDS/card_ (11).png', '../assets/img/CARDS/card_ (24).png' , '../assets/img/CARDS/card_ (37).png' , '../assets/img/CARDS/card_ (50).png'];
            let card_q = ['../assets/img/CARDS/card_ (12).png', '../assets/img/CARDS/card_ (25).png' , '../assets/img/CARDS/card_ (38).png' , '../assets/img/CARDS/card_ (51).png'];
            let card_k = ['../assets/img/CARDS/card_ (13).png', '../assets/img/CARDS/card_ (26).png' , '../assets/img/CARDS/card_ (39).png' , '../assets/img/CARDS/card_ (52).png'];

            let position;

            switch (card) {
                case "ace img": 
                    position = card_a[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "two img": 
                    position = card_2[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "three img": 
                    position = card_3[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "for img": 
                    position = card_4[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "five img": 
                    position = card_5[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "six img": 
                    position = card_6[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);;
                break;
                case "seven img": 
                    position = card_7[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "eight img": 
                    position = card_8[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "nein img": 
                    position = card_9[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "ten img": 
                    position = card_10[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "J img": 
                    position = card_j[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "Q img": 
                    position = card_q[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
                case "K img": 
                    position = card_k[Math.floor(Math.random() * card_a.length)];
                    return position;
                    card_a.splice(position, 1);
                break;
            }
        }

        let counter = 0;
        function displayCards(player, card) {
            const player_card_wrapper = document.getElementById('player')
            const dealer_card_wrapper = document.getElementById('dealer');
            const hidden_card = document.getElementById('hash');

            // console.log(card);

            if (player == 'player') {
                player_card_wrapper.innerHTML += `
                <div class="player-card">
                    <img src="${card}" alt="niet gevonden">
                </div>`
            }
            if (player == 'dealer') {
                dealer_card_wrapper.innerHTML += `
                <div class="player-card">
                    <img src="${card}" alt="niet gevonden">
                </div>`
            }
            if (player == 'dealer_hash') {
                dealer_card_wrapper.innerHTML += `
                <div class="player-card">
                    <img id="hash" src="../assets/img/CARDS/achterkant.png" alt="niet gevonden">
                </div>`
            }
            if (player == 'dealer-hidden') {
                // console.log(counter);
                if (counter == 0) {
                    hidden_card.src=`${card}`;
                    counter += 1;
                }
            }
        }
</script>