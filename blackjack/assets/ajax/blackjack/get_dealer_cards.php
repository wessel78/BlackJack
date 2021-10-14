<?php
    session_start();

    $score_player = array_sum($_SESSION['playercards']);
    $score_dealer = array_sum($_SESSION['dealercards']);

    if ($score_dealer < 21) {
        if ($_SESSION['game-active'] == true) {
            hideFirstDealerCard();
            checkAce();
            countScore();
        } else {
            echo "game-not-active";
        }
    }

    function hideFirstDealerCard() {

        // echo $_SESSION['dealer_card_count'];
        if ($_SESSION['dealer_card_count'] == 0) {
            //get dealer card
            $dealer_card = getDealerCards();
            // $hashed_dealer_card = sha1('sha265', $dealer_card);
            //save dealer card
            $_SESSION['hashed_dealer_card'] = array($dealer_card);
            echo "hidden-card";
        } else {
            echo getDealerCards();
        }
        $_SESSION['dealer_card_count'] += 1;
    }

    function getDealerCards() {
        //shuffling of all the cards.
        shuffle($_SESSION['cardnumber']);
        //bett/inzet (moet nog gemaakt worden).
        //draw card for the player.
            for ($i=0; $i<1; $i++) {
                //show the img of the card.
                $_SESSION['nextcard']++;
                // $dealer_card_count++;
                switch ($_SESSION['cardnumber'][$_SESSION['nextcard']]) {
                    case 1: return "ace img"; break;
                    case 2: return "two img"; break;
                    case 3: return "three img"; break;
                    case 4: return "for img"; break;
                    case 5: return "five img"; break;
                    case 6: return "six img"; break;
                    case 7: return "seven img"; break;
                    case 8: return "eight img"; break;
                    case 9: return "nein img"; break;
                    case 10: return "ten img"; break;
                    case 11: return "J img"; break;
                    case 12: return "Q img"; break;
                    case 13: return "K img"; break;
                }
            }
        }

        function checkAce() {
            //translate card to the correct value of the card.
            if ($_SESSION['cardnumber'][$_SESSION['nextcard']] == 1){
                array_push($_SESSION['dealercards'], 11);
            }
            elseif ($_SESSION['cardnumber'][$_SESSION['nextcard']] == 11||$_SESSION['cardnumber'][$_SESSION['nextcard']] == 12||$_SESSION['cardnumber'][$_SESSION['nextcard']] == 13) {
                array_push($_SESSION['dealercards'], 10);
            }
            else {
                array_push($_SESSION['dealercards'], $_SESSION['cardnumber'][$_SESSION['nextcard']]);
            }
        }
        
        function countScore() {
            // set ace(cards with value 11) to vallue 1 one by one if total value is > 21.
            while (array_sum($_SESSION['dealercards']) >21 && in_array(11, $_SESSION['dealercards'], $strict=true)) {
                $_SESSION['dealercards'][array_search(11,$_SESSION['dealercards'])] = 1;
            }
        }

            // echo "total player " . array_sum($_SESSION['dealercards'])."<br>";
            // echo "<br>";

?>