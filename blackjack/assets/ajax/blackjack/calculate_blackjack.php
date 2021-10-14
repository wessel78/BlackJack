<?php 
    session_start();

    echo $score_player = array_sum($_SESSION['playercards']);
    echo $score_dealer = array_sum($_SESSION['dealercards']);

        if ($score_player == 21)
        {
            echo "player-blackjack";
            $_SESSION['game-active'] = false;
            $_SESSION['session-start'] = false;

        }
        
?>