<?php 
    class blackjack {
        //all variables an arrays.

        function __construct() {
            $this->nextcard = $_SESSION['nextcard'] = 0;
            $this->dealercards = $_SESSION['dealercards'] = array();
            $this->playercards = $_SESSION['playercards'] = array();
        //declaring all the cards.
            $this->cardnumber = $_SESSION['cardnumber'] = array(
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
        }
        
    public function getPlayerCards($amount_run) {
        
    }
    // //controle.
        // echo "total player " . array_sum($this->playercards)."<br>";
        // echo "<br>";

    public function getDealerCards($amount_run) {
        //full automatic dealer goes BBBRRRRRRRRR....!
        while (array_sum($this->dealercards)<17) {
            //show the img of the card.
                switch ($this->cardnumber[$this->nextcard]) {
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
                echo "<br>";
            //
            //translate card to the correct value of the card.
                if ($this->cardnumber[$this->nextcard] == 11||$this->cardnumber[$this->nextcard] == 12||$this->cardnumber[$this->nextcard] == 13) {
                    array_push($this->dealercards, 10);
                }
                elseif($this->cardnumber[$this->nextcard] == 1){
                    array_push($this->dealercards, 11);
                }
                else {
                    array_push($this->dealercards, $this->cardnumber[$this->nextcard]);
                }
            //
            // set ace(cards with value 11) to value 1 one by one if total value is > 21.
                while (array_sum($this->dealercards) >21 && in_array(11, $this->dealercards, $strict=true)) {
                $this->dealercards[array_search(11,$this->dealercards)] = 1;
                    if (array_sum($this->dealercards) <=21) {
                        break;
                    }
                }
            //
            $this->nextcard++;
        }
    }


    // //controle.
    //     echo "total dealer " . array_sum($this->dealercards)."<br>";
    //     echo "<br> er zijn nu " . $this->nextcard . " kaarten van de stapelgetrokken.<br>";
    // //winning conditions (moeten nog gemmaakt worden).
    }
?>