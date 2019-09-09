<?php 
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        if(isset($_POST['select'])){
            if(isset($_COOKIE['tableGrind'])){
                unset($_COOKIE['tableGrind']);
                setcookie('tableGrind','',time() + 3600);
            }
            if(isset($_COOKIE['turnNb'])){
                unset($_COOKIE['turnNb']);
                setcookie('turnNb','', time() + 3600);
            }
        }
?>
<?php

    //définition des carrés 
    $cas0= $cas1= $cas2= $cas3= $cas4= $cas5= $cas6= $cas7= $cas8 = "00";
    $cases = array($cas0, $cas1, $cas2, $cas3, $cas4, $cas5, $cas6, $cas7, $cas8);

    $turn = $lastPlay = $grind = '';
    $acceptMove = false;
    if(isset($_GET['id']))
    $lastPlay = $_GET['id'];
    function pairOrOdd($nbToCheck){
        if($nbToCheck %2 == 1)
            return 5;
        else
            return 6;
    }
    $grind = $_COOKIE['tableGrind'];
    $arrayGrind = explode("/",$grind);

    if(isset($_COOKIE['tableGrind']) && !$pageWasRefreshed){
        $turn = $_COOKIE['turnNb'];
        if(substr($arrayGrind[$lastPlay], -1)==4){
            $arrayGrind[$lastPlay] = $lastPlay.pairOrOdd($turn);
            $turn++;
            setcookie('turnNb',$turn,time() + 3600);
        }
        $grind = implode("/",$arrayGrind);
        setcookie('tableGrind',$grind,time() + 3600);
    }else if(!$pageWasRefreshed){
        $grind = "04/14/24/34/44/54/64/74/84";//4 == null 5 == cross 6 == round
        setcookie('tableGrind',$grind,time() + 3600);
        setcookie('turnNb',0,time() + 3600);
    }

    //mise en place des images
    for($i = 0; $i < count($cases); $i++){
        if(strlen($arrayGrind[$i]) > 1)
        switch(substr($arrayGrind[$i], 1)){
            case 4:
            $cases[$i] = "Images/white.png";
            break;
            case 5:
            $cases[$i] = "Images/Cross.jpg";
            break;
            case 6:
            $cases[$i] = "Images/Round.jpg";
            break;
            default:
            $cases[$i] = "deffff";
            break;

        }
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TicTac</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div align= "middle">
        <img src="Images/emptyGrind.jpg" alt="Grille vide" usemap ="#yolo">
        <map name = "yolo">
        <area shape="rect" coords="0,0,105,105" alt="cas00" href="tictac.php?id=0">
        <area shape="rect" coords="107,0,220,105" alt="cas01" href="tictac.php?id=1">
        <area shape="rect" coords="215,0,335,105" alt="cas02" href="tictac.php?id=2">

        <area shape="rect" coords="0,110,105,235" alt="cas10" href="tictac.php?id=3">
        <area shape="rect" coords="107,110,220,235" alt="cas11" href="tictac.php?id=4">
        <area shape="rect" coords="215,110,335,235" alt="cas12" href="tictac.php?id=5">

        <area shape="rect" coords="0,220,105,360" alt="cas20" href="tictac.php?id=6">
        <area shape="rect" coords="107,220,220,360" alt="cas21" href="tictac.php?id=7">
        <area shape="rect" coords="215,220,335,360" alt="cas22" href="tictac.php?id=8">
        
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
        <input type="submit" name="select" value="Reset">
        </form>
        <a href="tictac.php?id=0">
            <img src="<?php echo $cases[0]; ?>" alt="" class="symbol row1 col1"/>
        </a>
        <a href="tictac.php?id=1">
            <img src="<?php echo $cases[1]; ?>" alt="" class="symbol row1 col2"/>
        </a>
        <a href="tictac.php?id=2">
            <img src="<?php echo $cases[2]; ?>" alt="" class="symbol row1 col3"/>
        </a>

        <a href="tictac.php?id=3">
            <img src="<?php echo $cases[3] ?>" alt="" class="symbol row2 col1"/>
        </a>
        <a href="tictac.php?id=4">
            <img src="<?php echo $cases[4] ?>" alt="" class="symbol row2 col2"/>
        </a>
        <a href="tictac.php?id=5">
            <img src="<?php echo $cases[5] ?>" alt="" class="symbol row2 col3"/>
        </a>

        <a href="tictac.php?id=6">
            <img src="<?php echo $cases[6] ?>" alt="" class="symbol row3 col1"/>
        </a>
        <a href="tictac.php?id=7">
            <img src="<?php echo $cases[7] ?>" alt="" class="symbol row3 col2"/>
        </a>
        <a href="tictac.php?id=8">
            <img src="<?php echo $cases[8] ?>" alt="" class="symbol row3 col3"/>
        </a>
    </div>
    <div>
        <p>
            <?php
                echo $lastPlay."<br>";
                echo $turn."<br>";
                echo $grind."<br>";
                //vérification de victoire

            ?>
        </p>
    </div>
</body>
</html>