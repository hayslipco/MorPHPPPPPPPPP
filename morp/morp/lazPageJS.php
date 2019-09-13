<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LazPageJS</title>

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
        <img src="Images/pavicevila.png" alt="lazer" id="laz" style="width:1%;height:1%;"/>
        <script>
            var dimension = 1;
        var x = setInterval(function(){
            dimension += 0.01;
            document.getElementById('laz').style.width = dimension + "%";
            document.getElementById('laz').style.height = dimension * 2 + "%";
        }, 5);
        </script>
    </div>
</body>
</html>