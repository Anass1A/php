/* add.php - Fiets toevoegen */
<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $merk = $_POST['merk'];
    $type = $_POST['type'];
    $prijs = $_POST['prijs'];
    
    $stmt = $pdo->prepare("INSERT INTO fietsen (merk, type, prijs) VALUES (?, ?, ?)");
    $stmt->execute([$merk, $type, $prijs]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Fiets toevoegen</h1>
    <form method="post">
        Merk: <input type="text" name="merk" required><br>
        Type: <input type="text" name="type" required><br>
        Prijs: <input type="number" name="prijs" required><br>
        <input type="submit" value="Toevoegen">
    </form>
</body>
</html>
