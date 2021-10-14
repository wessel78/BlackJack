<?php 
    require ('global_variable.php');
    session_start();
    $_SESSION['current_bet_money'] = $_POST['current-bet'];
    $_SESSION['total_balance_money'] = $_POST['total-balance'];

    if ($_SESSION['current_bet_money'] > 0) {
        $_SESSION['session-start'] = true;
        $_SESSION['game-active'] = true;
        echo "session-created";
    }
?>