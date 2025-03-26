<?php
    require_once('functions.php');

    // Haal het id op uit de URL
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $row = getRecord($id);
    }

    if(isset($_POST['btn_wzg'])){
        if(updateRecord($_POST) == true){
            echo "<script>alert('Brouwer is gewijzigd')</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Brouwer is NIET gewijzigd')</script>";
        }
    }
?>

<html>
    <body>
        <form method="post">
            <input type="hidden" name="brouwcode" value="<?php echo $row['brouwcode']; ?>">

            <label for="naam">Naam:</label>
            <input type="text" name="naam" value="<?php echo $row['naam']; ?>" required><br>

            <label for="land">Land:</label>
            <input type="text" name="land" value="<?php echo $row['land']; ?>" required><br>

            <input type="submit" name="btn_wzg" value="Wijzig">
        </form>

        <br><br>
        <a href='index.php'>Home</a>
    </body>
</html>

