<?php require ('backend/money.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/scss/style.css">
    <title>Blackjack</title>
</head>
<body>
    <section class="main-wrapper">
        <div class="content-wrapper">
            <div class="img-wrapper">
                <img src="../assets/img/blackjack-logo.png" alt="Foto niet gevonden" width="500px">
            </div>
            <button id="play-btn">Play</button>
            <div id="warning" class="warning">
                <p>U moet minimaal een inleg hebben van 5$</p>
            </div>
        </div>

        <footer class="footer-wrapper">
            <div class="footer-content-wrapper">
                <div class="balance-wrapper">
                    <label for="total-balance">Totaal</label>
                    <input type="number" min="0" value="<?php echo $total_balance ?>" name="total-balance" id="total-balance">
                </div>

                <div class="btn-wrapper">
                    <div id="min-geld" class="min-geld">
                        <p>- 5</p>
                    </div>

                    <div class="balance-wrapper">
                        <label for="current-bet">Inzetten</label>
                        <input type="number" min="0" value="<?php echo $amount_betted ?>" name="current-bet" id="current-bet">
                    </div>

                    <div id="plus-geld" class="plus-geld">
                        <p>+ 5</p>
                    </div>
                </div>
            </div>
        </footer>
    </section>
</body>
</html>

<script>
    //Reset game session
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log('Session has been reset');
        }
    };
    xhr.open("POST", "../assets/ajax/reset_game_session.php", true);
    xhr.send();

    //Disable input fields
    const total_balance = document.getElementById('total-balance');
    const amount_betted = document.getElementById('current-bet');

    total_balance.disabled = true;
    amount_betted.disabled = true;

    //Balance
    let total_balance_money = 1000;
    let amount_betted_money = 0;

    // Add or remove amount
    const add_5_dollar = document.getElementById('plus-geld');
    const remove_5_dollar = document.getElementById('min-geld');

    //Add ammount
    add_5_dollar.addEventListener('click', () => {
        if (total_balance_money != 0) {
            total_balance_money -= 5;
            amount_betted_money += 5;
        }
        
        //Update input fields
        total_balance.value = total_balance_money;
        amount_betted.value = amount_betted_money;
        
    })

    //Remove ammount
    remove_5_dollar.addEventListener('click', () => {
        if (amount_betted_money != 0) {
            total_balance_money += 5;
            amount_betted_money -= 5;
        }
        
        //Update input fields
        total_balance.value = total_balance_money;
        amount_betted.value = amount_betted_money;
    });

    //Start game session
    const play_btn = document.getElementById('play-btn');

    play_btn.addEventListener('click', () => {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
                console.log(xhr.responseText);
                if (xhr.responseText == "session-created") {
                    window.location.href = "blackjack.php";
                } else {
                    const warning_modal = document.getElementById('warning');
                    warning_modal.style.display = "flex";

                    setTimeout(() => {
                        warning_modal.style.display = "none";
                    }, 10000);
                }
            }
        };
        xhr.open("POST", "../assets/ajax/start_game_session.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('current-bet='+amount_betted_money+'&total-balance='+total_balance_money);
    });

</script>