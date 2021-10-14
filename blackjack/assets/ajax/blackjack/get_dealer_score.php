<?php 
    session_start();

    $score_player = array_sum($_SESSION['playercards']);
    $score_dealer = array_sum($_SESSION['dealercards']);
    echo $score_dealer;
?>