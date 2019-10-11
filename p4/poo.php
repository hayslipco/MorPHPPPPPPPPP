<?php
session_start();
$_SESSION['played'] = false;
class Token
{

    private $color;
    private $X;
    private $Y;

    /**
     * Constructoz
     *
     * @param $color
     * @param $X
     * @param $Y
     */
    function __construct($color, $X)
    {
        $this->setColor($color);
        $this->X = $X;
    }

    /**
     * Change la couleur du game
     *
     * @param $color
     */
    private function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * Récup dat couleur
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Récup dat position horizontale
     */
    public function getX()
    {
        return $this->X;
    }

    /**
     * definit le y des tokens
     *
     * @param $y
     */
    public function setY($y)
    {

        $this->Y = $y;
    }

    /**
     * Réc dat Y
     */
    public function getY()
    {
        return $this->Y;
    }
}

class Grid
{

    private $width;
    private $height;
    private $gameGrid;

    function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;

        $Grid = array();

        for ($i = 0; $i < $height; $i++) {
            $line = array();

            for ($j = 0; $j < $width; $j++) {
                $line[] = 0;
            }
            $Grid[] = $line;
        }

        $this->gameGrid = $Grid;
    }

    public function placeToken($token)
    {
        $colorCode = 0;
        $x = $token->getX();
        $y = 0;

        //Check de la colonne + placement de Y
        for ($i = 0; $i < $this->height; $i++) {
            if ($this->gameGrid[$i][$x] != 0 || $i == $this->height - 1 && $x <= $this->width && $y <= $this->height) {
                if ($i == $this->height - 1 && $this->gameGrid[$i][$x] == 0)
                    $y = $i;
                else
                    $y = $i - 1;

                $token->setY($y);
                break;
            } else {
                $y = null;
            }
        }

        if ($x <= $this->width && $y <= $this->height && $y >= 0) {
            switch ($token->getColor()) {
                case 'Green':
                    $colorCode = 1;
                    break;
                case 'Blue':
                    $colorCode = 2;
                    break;
                default:
                    $colorCode = 0;
            }
            $this->gameGrid[$y][$x] = $colorCode;
            $_SESSION['played'] = true;
        }
    }

    /*public function printGrid()
    {
        foreach($this->gameGrid as $line){
            foreach($line as $tile){
                echo "| $tile |";
            }
            echo "<br>";
        }
    } */

    public function printGrid()
    {
        foreach ($this->gameGrid as $line) {
            foreach ($line as $tile) {
                echo '<img src="images/Token' . $tile . '.jpg" alt="Token" style="width:50px;height:50px;">';
            }
            echo "<br>";
        }
    }

    public function setButtons()
    {
        echo '<form action="" method="get">';
        for ($i = 0; $i < count($this->gameGrid[0]); $i++) {
            echo '<input type="submit" value="' . $i . '" name="input" style="width:50px;height:50px;">';
        }
        echo '                                             <input type="submit" value="Reset" name="reset" style="width:50px;height:50px;">';
        echo '</form>';
    }
}
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sale</title>
    </head>

    <body style="margin:2%;">
        <?php

        if (isset($_GET['reset'])) {
            session_destroy();
        }

        if (isset($_SESSION['grid']) && !isset($_GET['reset'])) {
            $grid = $_SESSION['grid'];
        } else {
            $grid = new Grid(8, 8);
        }

        if (isset($_SESSION['turn'])) {
            $turn = $_SESSION['turn'];
        } else {
            $turn = 'Green';
        }

        $grid->setButtons();

        if (isset($_GET['input'])) {
            $grid->placeToken(new Token($turn, $_GET['input']));
        }
        $grid->printGrid();

        if ($_SESSION['played']) {
            if ($turn == 'Green') {
                $_SESSION['turn'] = 'Blue';
            } else {
                $_SESSION['turn'] = 'Green';
            }
        }

        $_SESSION['grid'] = $grid;



        ?>
        <!--<img src="" alt="">-->
    </body>

    </html>