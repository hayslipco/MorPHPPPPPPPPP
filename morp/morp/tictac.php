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
    $cas0= $cas1= $cas2= $cas3= $cas4= $cas5= $cas6= $cas7= $cas8 = "";
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
    //mise en place du tableau de jeu
    $grind = $_COOKIE['tableGrind'];
    $arrayGrind = explode("/",$grind);

    if(isset($_COOKIE['tableGrind']) ){
        $turn = $_COOKIE['turnNb'];
        if(substr($arrayGrind[$lastPlay], -1)==4){
            $arrayGrind[$lastPlay] = $lastPlay.pairOrOdd($turn);
            $turn++;
            setcookie('turnNb',$turn,time() + 3600);
            
        }
        $grind = implode("/",$arrayGrind);
        setcookie('tableGrind',$grind,time() + 3600);
    }else{
        $grind = "04/14/24/34/44/54/64/74/84";//4 == null 6 == cross 5 == round
        setcookie('tableGrind',$grind,time() + 3600);
        setcookie('turnNb',0,time() + 3600);
        $arrayGrind = explode("/", $grind);
    }

    //mise en place des images
    for($i = 0; $i < count($cases); $i++){
        switch(substr($arrayGrind[$i], -1)){
            case 4:
            $cases[$i] = "Images/white.png";
            break;

            case 6:
            $cases[$i] = "Images/Cross.jpg";
            break;
            
            case 5:
            $cases[$i] = "Images/Round.jpg";
            break;
        }
    }

    //vérification de la victoire
    if($_COOKIE['turnNb'] >= 5){
        



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
        <!--<img src="Images/emptyGrind.jpg" alt="Grille vide">-->

        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
        <input type="submit" name="select" value="Reset" class="resetButt">
        </form>
        <?php 
        $war=0;
        for($k = 1;$k <= 3;$k++){
            for($l = 1; $l <= 3;$l++){
                echo "<a href = \"tictac.php?id=$war\"> <img src=\"$cases[$war]\" class=\"symbol row$k col$l\"/></a>" ;
                $war++;
            }
        }
        ?>
    </div>
    <div>
        <p>
            <?php
                echo $lastPlay."<br>";
                echo $turn."<br>";
                echo $grind."<br>";
                echo count($cases) . "<br>";
            ?>
        </p>
    </div>
</body>
</html>