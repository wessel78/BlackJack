<?php 
    // require ('get_dealer_cards.php');
    session_start();

    $score_player = array_sum($_SESSION['playercards']);
    $score_dealer = array_sum($_SESSION['dealercards']);
    echo $score_dealer;


    
    // if ($score_dealer < 17) {
    // // echo $score_dealer;
    // //shuffling of all the cards.
    // shuffle($_SESSION['cardnumber']);
    // //bett/inzet (moet nog gemaakt worden).
    // //draw card for the player.
    //     for ($i=0; $i<1; $i++) {
    //         //show the img of the card.
    //         $_SESSION['nextcard']++;
    //         // $dealer_card_count++;
    //         switch ($_SESSION['cardnumber'][$_SESSION['nextcard']]) {
    //             case 1: echo "ace img"; break;
    //             case 2: echo "two img"; break;
    //             case 3: echo "three img"; break;
    //             case 4: echo "for img"; break;
    //             case 5: echo "five img"; break;
    //             case 6: echo "six img"; break;
    //             case 7: echo "seven img"; break;
    //             case 8: echo "eight img"; break;
    //             case 9: echo "nein img"; break;
    //             case 10: echo "ten img"; break;
    //             case 11: echo "J img"; break;
    //             case 12: echo "Q img"; break;
    //             case 13: echo "K img"; break;
    //         }
    //     }
    //     //translate card to the correct value of the card.
    //     if ($_SESSION['cardnumber'][$_SESSION['nextcard']] == 1){
    //         array_push($_SESSION['dealercards'], 11);
    //     }
    //     elseif ($_SESSION['cardnumber'][$_SESSION['nextcard']] == 11||$_SESSION['cardnumber'][$_SESSION['nextcard']] == 12||$_SESSION['cardnumber'][$_SESSION['nextcard']] == 13) {
    //         array_push($_SESSION['dealercards'], 10);
    //     }
    //     else {
    //         array_push($_SESSION['dealercards'], $_SESSION['cardnumber'][$_SESSION['nextcard']]);
    //     }
    //     // set ace(cards with value 11) to vallue 1 one by one if total value is > 21.
    //     while (array_sum($_SESSION['dealercards']) >21 && in_array(11, $_SESSION['dealercards'], $strict=true)) {
    //         $_SESSION['dealercards'][array_search(11,$_SESSION['dealercards'])] = 1;
    //     }
    // } else {
    //     echo "higher-then-17";
    // }
?>