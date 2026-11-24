<?php
$konekcija = mysqli_connect("localhost", "root", "", "korisnici");

if (!$konekcija) {
    die("Greška pri spajanju: " . mysqli_connect_error());
}

$poruka = "";
$urediKorisnik = null;

if (isset($_GET['obrisi'])) {
    $id = (int) $_GET['obrisi'];
    mysqli_query($konekcija, "DELETE FROM korisnik WHERE id = $id");
    $poruka = "Korisnik je obrisan.";
}

if (isset($_GET['uredi'])) {
    $id = (int) $_GET['uredi'];
    $upit = mysqli_query($konekcija, "SELECT * FROM korisnik WHERE id = $id");
    $urediKorisnik = mysqli_fetch_assoc($upit);
}

if (isset($_POST['azuriraj'])) {
    $id = (int) $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $boja = $_POST['favorite_color'];
    $prijatelji = (int) $_POST['freinds'];

    mysqli_query($konekcija, "UPDATE korisnik SET username='$username', password='$password', favorite_color='$boja', freinds=$prijatelji WHERE id=$id");
    $poruka = "Korisnik je izmijenjen.";
    $urediKorisnik = null;
}

if (isset($_POST['posalji'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $boja = $_POST['favorite_color'];
    $prijatelji = (int) $_POST['freinds'];

    mysqli_query($konekcija, "INSERT INTO korisnik (username, password, favorite_color, freinds) VALUES ('$username', '$password', '$boja', $prijatelji)");
    $poruka = "Korisnik je dodan.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>
</head>
<body>

    <?php if ($poruka != ""): ?>
        <p><b><?php echo $poruka; ?></b></p>
    <?php endif; ?>

    <h2><?php echo $urediKorisnik ? "Uredi korisnika" : "Dodaj korisnika"; ?></h2>

    <form method="POST" action="">
        <?php if ($urediKorisnik): ?>
            <input type="hidden" name="id" value="<?php echo $urediKorisnik['id']; ?>">
        <?php endif; ?>

        Korisničko ime:<br>
        <input type="text" name="username" required value="<?php echo $urediKorisnik['username'] ?? ''; ?>"><br><br>

        Lozinka:<br>
        <input type="text" name="password" required value="<?php echo $urediKorisnik['password'] ?? ''; ?>"><br><br>

        Omiljena boja:<br>
        <input type="text" name="favorite_color" value="<?php echo $urediKorisnik['favorite_color'] ?? ''; ?>"><br><br>

        Broj prijatelja:<br>
        <input type="number" name="freinds" value="<?php echo $urediKorisnik['freinds'] ?? ''; ?>"><br><br>

        <?php if ($urediKorisnik): ?>
            <button type="submit" name="azuriraj">Sačuvaj izmjene</button>
            <a href="index.php">Odustani</a>
        <?php else: ?>
            <button type="submit" name="posalji">Spremi u bazu</button>
        <?php endif; ?>
    </form>

    <hr>

    <h2>Korisnici</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Boja</th>
            <th>Prijatelja</th>
            <th>Akcije</th>
        </tr>

        <?php
        $rezultat = mysqli_query($konekcija, "SELECT * FROM korisnik");
        while ($red = mysqli_fetch_assoc($rezultat)) {
            echo "<tr>";
            echo "<td>" . $red['id'] . "</td>";
            echo "<td>" . $red['username'] . "</td>";
            echo "<td>" . $red['favorite_color'] . "</td>";
            echo "<td>" . $red['freinds'] . "</td>";
            echo "<td>";
            echo "<a href='?uredi=" . $red['id'] . "'>Uredi</a> | ";
            echo "<a href='?obrisi=" . $red['id'] . "'>Obriši</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>