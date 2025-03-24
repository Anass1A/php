/* index.php - Overzicht van fietsen */
<?php
include 'config.php';
$query = $pdo->query("SELECT * FROM fietsen");
$fietsen = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fietsenshop</title>
</head>
<body>
    <h1>Fietsenshop</h1>
    <a href="add.php">Fiets toevoegen</a>
    <table border="1">
        <tr>
            <th>Merk</th>
            <th>Type</th>
            <th>Prijs</th>
            <th>Wijzig</th>
            <th>Verwijderen</th>
        </tr>
        <?php foreach ($fietsen as $fiets): ?>
        <tr>
            <td><?= htmlspecialchars($fiets['merk']) ?></td>
            <td><?= htmlspecialchars($fiets['type']) ?></td>
            <td><?= htmlspecialchars($fiets['prijs']) ?></td>
            <td><a href="edit.php?id=<?= $fiets['id'] ?>">Wijzig</a></td>
            <td><a href="delete.php?id=<?= $fiets['id'] ?>">Verwijder</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
