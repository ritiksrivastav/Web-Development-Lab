<?php
/***
* File: index.php
* Author: design1online.com, LLC
* Created: 1.31.2012
* License: Public GNU
* Description: PHP/MySQL Version of 2 Player Tic Tac Toe
***/
require_once('oop/class.game.php');
require_once('oop/class.tictactoe.php');

//this will store their information as they refresh the page
session_start();

//if they haven't started a game yet let's load one
if (!$_SESSION['game']['tictactoe'])
    $_SESSION['game']['tictactoe'] = new tictactoe();

?>
<html>
    <head>
        <title>Tic Tac Toe</title>
        <link rel="stylesheet" type="text/css" href="inc/style.css" />
    </head>
    <body>
        <div id="content">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <h2>Let's Play Tic Tac Toe!</h2>
        <?php
            $_SESSION['game']['tictactoe']->playGame($_POST);
        ?>
        </form>
        </div>
    </body>
</html>


<?php
/***
* File: oop/class.tictactoe.php
* Author: design1online.com, LLC
* Created: 1.31.2012
* License: Public GNU
* Description: tic tac toe game
***/

class tictactoe extends game
{
    var $player = "X";            //whose turn is
    var $board = array();        //the tic tac toe board
    var $totalMoves = 0;        //how many moves have been made so far        

    /**
    * Purpose: default constructor
    * Preconditions: none
    * Postconditions: parent object started
    **/
    function tictactoe()
    {
        /**
        * instantiate the parent game class so this class
        * inherits all of the game class's attributes 
        * and methods
        **/
        game::start();
    }

    /**
    * Purpose: start a new tic tac toe game
    * Preconditions: maximum number of guesses
    * Postconditions: game is ready to be displayed
    **/
    function newGame()
    {
        //setup the game
        $this->start();

        //reset the player
        $this->player = "X";
        $this->totalMoves = 0;

        //clear out the board
        $this->board = array();
    }

    /**
    * Purpose: run the game until it's tied or someone has won
    * Preconditions: all $_POST content
    * Postconditions: game is in play
    **/
    function playGame($postdata)
    {
        if (!$this->isOver() && $postdata['move'])
            $this->move($postdata);

        //player pressed the button to start a new game
        if ($_POST['newgame'])
            $this->newGame();

        //display the game
        $this->displayGame();
    }

    /**
    * Purpose: display the game interface
    * Preconditions: none
    * Postconditions: start a game or keep playing the current game
    **/
    function displayGame()
    {

        //while the game isn't over
        if (!$this->isOver())
        {
            echo "<div id=\"board\">";

            for ($x = 0; $x < 3; $x++)
            {
                for ($y = 0; $y < 3; $y++)
                {
                    echo "<div class=\"board_cell\">";

                    //check to see if that position is already filled
                    if ($this->board[$x][$y])
                        echo "<img src=\"images/{$this->board[$x][$y]}.jpg\" alt=\"{$this->board[$x][$y]}\" title=\"{$this->board[$x][$y]}\" />";
                    else
                    {
                        //let them choose to put an x or o there
                        echo "<select name=\"{$x}_{$y}\">
                                <option value=\"\"></option>
                                <option value=\"{$this->player}\">{$this->player}</option>
                            </select>";
                    }

                    echo "</div>";
                }

                echo "<div class=\"break\"></div>";
            }

            echo "
                <p align=\"center\">
                    <input type=\"submit\" name=\"move\" value=\"Take Turn\" /><br/>
                    <b>It's player {$this->player}'s turn.</b></p>
            </div>";
        }
        else
        {

            //someone won the game or there was a tie
            if ($this->isOver() != "Tie")
                echo successMsg("Congratulations player " . $this->isOver() . ", you've won the game!");
            else if ($this->isOver() == "Tie")
                echo errorMsg("Whoops! Looks like you've had a tie game. Want to try again?");

            session_destroy(); 

            echo "<p align=\"center\"><input type=\"submit\" name=\"newgame\" value=\"New Game\" /></p>";
        }
    }

    /**
    * Purpose: trying to place an X or O on the board
    * Preconditions: the position they want to make their move
    * Postconditions: the game data is updated
    **/
    function move($postdata)
    {            

        if ($this->isOver())
            return;

        //remove duplicate entries on the board    
        $postdata = array_unique($postdata);

        foreach ($postdata as $key => $value)
        {
            if ($value == $this->player)
            {    
                //update the board in that position with the player's X or O 
                $coords = explode("_", $key);
                $this->board[$coords[0]][$coords[1]] = $this->player;

                //change the turn to the next player
                if ($this->player == "X")
                    $this->player = "O";
                else
                    $this->player = "X";

                $this->totalMoves++;
            }
        }

        if ($this->isOver())
            return;
    }

    /**
    * Purpose: check for a winner
    * Preconditions: none
    * Postconditions: return the winner if found
    **/
    function isOver()
    {

        //top row
        if ($this->board[0][0] && $this->board[0][0] == $this->board[0][1] && $this->board[0][1] == $this->board[0][2])
            return $this->board[0][0];

        //middle row
        if ($this->board[1][0] && $this->board[1][0] == $this->board[1][1] && $this->board[1][1] == $this->board[1][2])
            return $this->board[1][0];

        //bottom row
        if ($this->board[2][0] && $this->board[2][0] == $this->board[2][1] && $this->board[2][1] == $this->board[2][2])
            return $this->board[2][0];

        //first column
        if ($this->board[0][0] && $this->board[0][0] == $this->board[1][0] && $this->board[1][0] == $this->board[2][0])
            return $this->board[0][0];

        //second column
        if ($this->board[0][1] && $this->board[0][1] == $this->board[1][1] && $this->board[1][1] == $this->board[2][1])
            return $this->board[0][1];

        //third column
        if ($this->board[0][2] && $this->board[0][2] == $this->board[1][2] && $this->board[1][2] == $this->board[2][2])
            return $this->board[0][2];

        //diagonal 1
        if ($this->board[0][0] && $this->board[0][0] == $this->board[1][1] && $this->board[1][1] == $this->board[2][2])
            return $this->board[0][0];

        //diagonal 2
        if ($this->board[0][2] && $this->board[0][2] == $this->board[1][1] && $this->board[1][1] == $this->board[2][0])
            return $this->board[0][2];

        if ($this->totalMoves >= 9)
            return "Tie";
    }
}