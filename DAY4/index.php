<?php

$konekcija = mysqli_connect("localhost", "root", "", "autoservisi_db");
$rezultat = mysqli_query($konekcija, "SELECT * FROM autoservisi");
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>DAY4</title>
</head>
<body>

    <h2>Popis autoservisa</h2>
    
    <table border="1" cellpadding="8">
        <tr>
            <th>Naziv</th>
            <th>Grad</th>
            <th>Telefon</th>
            <th>Ocjena</th>
        </tr>

  
        <?php while($red = mysqli_fetch_assoc($rezultat)): ?>
        <tr>
            <td><?php echo $red['naziv']; ?></td>
            <td><?php echo $red['grad']; ?></td>
            <td><?php echo $red['telefon']; ?></td>
            <td><?php echo $red['ocjena']; ?></td>
        </tr>
        <?php endwhile; ?>

    </table>

</body>
</html>