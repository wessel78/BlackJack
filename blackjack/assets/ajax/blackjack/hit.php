<?php 
    // require ('calculate_score.php');
    session_start();

    $score_player = array_sum($_SESSION['playercards']);
    $score_dealer = array_sum($_SESSION['dealercards']);

    // echo $score_player;

    if ($score_player > 21) 
    {
        // echo $score_player;
        echo "player-lose";
        // $_SESSION['game-active'] = false;
    }

?>