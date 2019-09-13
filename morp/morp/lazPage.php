<?php
    if(isset($_COOKIE["visits"])){
        $visits = $_COOKIE["visits"];
        setcookie("visits", $visits + 1, time() + 3600);
    } else{
        setcookie("visits", 1, time() + 3600 * 24);
    }

    $dimension = 10 * $visits;
    $styleString = "\"width:$dimension" . "px;height:$dimension" . ";\""; 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LazPage</title>

<style type="text/css">
html, body
{
    height: 100%;
    margin:0;
    padding:0;
}

div {
    position:relative;
    height: 100%;
    width:100%;
}

div img {
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    margin:auto;
}

</style>

</head>
<body>
    <div>
        <img src="Images/pavicevila.png" alt="lazer" style=<?php echo $styleString ?>/>
    </div>
</body>
</html>