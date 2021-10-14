<?php
    session_start();

    $score_player = array_sum($_SESSION['playercards']);
    $score_dealer = array_sum($_SESSION['dealercards']);

    if ($score_player < 21) {
        if ($_SESSION['game-active'] == true) {
        getPlayerCards();
        checkAce();
        countScore();
        } else {
            echo "game-not-active";
        }
    }


    function getPlayerCards() {
        //shuffling of all the cards.
        shuffle($_SESSION['cardnumber']);
        //bett/inzet (moet nog gemaakt worden).
        //draw card for the player.
            for ($i=0; $i<1; $i++) {
                //show the img of the card.
                $_SESSION['nextcard']++;
                switch ($_SESSION['cardnumber'][$_SESSION['nextcard']]) {
                    case 1: echo "ace img"; break;
                    case 2: echo "two img"; break;
                    case 3: echo "three img"; break;
                    case 4: echo "for img"; break;
                    case 5: echo "five img"; break;
                    case 6: echo "six img"; break;
                    case 7: echo "seven img"; break;
                    case 8: echo "eight img"; break;
                    case 9: echo "nein img"; break;
                    case 10: echo "ten img"; break;
                    case 11: echo "J img"; break;
                    case 12: echo "Q img"; break;
                    case 13: echo "K img"; break;
                }
            }
        }

        function checkAce() {
            //translate card to the correct value of the card.
            if ($_SESSION['cardnumber'][$_SESSION['nextcard']] == 1){
                array_push($_SESSION['playercards'], 11);
            }
            elseif ($_SESSION['cardnumber'][$_SESSION['nextcard']] == 11||$_SESSION['cardnumber'][$_SESSION['nextcard']] == 12||$_SESSION['cardnumber'][$_SESSION['nextcard']] == 13) {
                array_push($_SESSION['playercards'], 10);
            }
            else {
                array_push($_SESSION['playercards'], $_SESSION['cardnumber'][$_SESSION['nextcard']]);
            }
        }
        
        function countScore() {
            // set ace(cards with value 11) to vallue 1 one by one if total value is > 21.
            while (array_sum($_SESSION['playercards']) >21 && in_array(11, $_SESSION['playercards'], $strict=true)) {
                $_SESSION['playercards'][array_search(11,$_SESSION['playercards'])] = 1;
            }
        }

            // echo "total player " . array_sum($_SESSION['playercards'])."<br>";
            // echo "<br>";

?>