
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAY1</title>
</head>
<body>
<h1>Dobrodošli na moju prvu backend stranicu!</h1>
<p>
<?php
$ime = "korisnik";
echo "Zdravo, " . $ime . "! (Ova poruka je generisana preko PHP-a)"
?>  
</p>
 

<p>Današnji datum je: 
        <?php 
            echo date("d.m.Y."); 
        ?>
    </p>
</body>
</html>