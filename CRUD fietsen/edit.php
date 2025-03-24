/* edit.php - Fiets wijzigen */
<?php
include 'config.php';
$id = $_GET['id'];
$query = $pdo->prepare("SELECT * FROM fietsen WHERE id = ?");
$query->execute([$id]);
$fiets = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $merk = $_POST['merk'];
    $type = $_POST['type'];
    $prijs = $_POST['prijs'];
    
    $stmt = $pdo->prepare("UPDATE fietsen SET merk = ?, type = ?, prijs = ? WHERE id = ?");
    $stmt->execute([$merk, $type, $prijs, $id]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Fiets wijzigen</h1>
    <form method="post">
        Merk: <input type="text" name="merk" value="<?= htmlspecialchars($fiets['merk']) ?>" required><br>
        Type: <input type="text" name="type" value="<?= htmlspecialchars($fiets['type']) ?>" required><br>
        Prijs: <input type="number" name="prijs" value="<?= htmlspecialchars($fiets['prijs']) ?>" required><br>
        <input type="submit" value="Wijzigen">
    </form>
</body>
</html>
