<?php 
// session_start();
    $_SESSION['nextcard'] = 0;
    $_SESSION['dealercards'] = array();
    $_SESSION['playercards'] = array();
        //declaring all the cards.
    $_SESSION['cardnumber'] = array(
        1,1,1,1,    //ace value = 11||1
        2,2,2,2,    //2 value = 2
        3,3,3,3,    //3 value = 3
        4,4,4,4,    //4 value = 4
        5,5,5,5,    //5 value = 5
        6,6,6,6,    //6 value = 6
        7,7,7,7,    //7 value = 7
        8,8,8,8,    //8 value = 8
        9,9,9,9,    //9 value = 9
        10,10,10,10,//10 value = 10
        11,11,11,11,//j value = 10
        12,12,12,12,//q value = 10
        13,13,13,13,//k value = 10
    );
    $_SESSION['dealer_card_count'] = 0;
    $_SESSION['hashed_dealer_card'] = array();
    
?>