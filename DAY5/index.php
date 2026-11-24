<?php

$konekcija = mysqli_connect("localhost", "root", "", "korisnici");


if (!$konekcija) {
    die("Greška pri spajanju: " . mysqli_connect_error());
}


if (isset($_POST['posalji'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $boja = $_POST['favorite_color'];
    $prijatelji = $_POST['freinds'];

  
    $sql = "INSERT INTO korisnik (username, password, favorite_color,freinds) 
            VALUES ('$username', '$password', '$boja', '$prijatelji')";

    mysqli_query($konekcija, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Unos i prikaz podataka</title>
</head>
<body>

    <h2>Forma za unos korisnika</h2>
    <form method="POST" action="">
        <label>Korisničko ime:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Lozinka:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Omiljena boja:</label><br>
        <input type="text" name="favorite_color"><br><br>

        <label>Broj prijatelja:</label><br>
        <input type="number" name="freinds"><br><br>

        <button type="submit" name="posalji">Spremi u bazu</button>
    </form>

    <hr>

    <h2>Lista korisnika iz baze</h2>
    <table border="1" cellpadding="8">
        <tr>
            
            <th>Username</th>
            <th>Boja</th>
            <th>Prijatelja</th>
        </tr>

        <?php
     
        $rezultat = mysqli_query($konekcija, "SELECT * FROM korisnik");

   
        while ($red = mysqli_fetch_assoc($rezultat)) {
            echo "<tr>";
            
            echo "<td>" . $red['username'] . "</td>";
            echo "<td>" . $red['favorite_color'] . "</td>";
            echo "<td>" . $red['freinds'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</htm