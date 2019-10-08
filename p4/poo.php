<?php
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
    function __construct($color, $X, $Y)
    {
        $this->setColor($color);
        $this->X = $X;
        $this->Y = $Y;
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
        for($i = 0;$i < $this->height;$i++){
            if($this->gameGrid[$i][$x] != 0 || $i == $this->height-1){
                $y = $i-1;
                break;
            }
        }

        if($x <= $this->width && $y <= $this->height){
        switch($token->getColor()){
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
        } else{
            echo "like what ? OOB";
        }
    }

    public function printGrid()
    {
        $num = 0;
        foreach($this->gameGrid as $line){
            foreach($line as $tile){
                echo "| $tile |";
            }

            $num++;
            echo "$num<br>";
        }
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
        $grid = new Grid(8,8);
        $clicks = array();
        $clicks[] = new Token('Green',1,6);
        $clicks[] = new Token('Blue',0,6);
        $clicks[] = new Token('Green',2,5);
        $clicks[] = new Token('Blue',3,4);
        $clicks[] = new Token('Green',4,3);
        $clicks[] = new Token('Blue',5,2);
        $clicks[] = new Token('Green',6,1);
        $clicks[] = new Token('Blue',7,0);
        foreach($clicks as $token){
            $grid->placeToken($token);

        }
        $grid->printGrid();

        for($o = 0; $o < 8;$o++){
            echo "";
        }
    ?>
    <!--<img src="" alt="">-->
</body>

</html>