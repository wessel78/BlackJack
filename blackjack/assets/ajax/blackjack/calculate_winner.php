<?php 
    session_start();

    $score_player = array_sum($_SESSION['playercards']);
    $score_dealer = array_sum($_SESSION['dealercards']);

    if ($score_player == $score_dealer) {
        echo "draw";
        $_SESSION['game-active'] = false;
        $_SESSION['session-start'] = false;
    } elseif ($score_player < $score_dealer) {
        echo "player-win";
        $_SESSION['game-active'] = false;
        $_SESSION['session-start'] = false;
    } elseif ($score_dealer < $score_player) {
        echo "dealer-win";
        $_SESSION['game-active'] = false;
        $_SESSION['session-start'] = false;
    }
?>