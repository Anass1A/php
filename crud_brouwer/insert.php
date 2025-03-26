<?php
    require_once('functions.php');

    if(isset($_POST['btn_ins'])){
        if(insertRecord($_POST) == true){
            echo "<script>alert('Brouwer is toegevoegd')</script>";
            echo "<script>window.location.href = 'index.php';</script>"; // Redirect naar index.php
        } else {
            echo "<script>alert('Brouwer is NIET toegevoegd')</script>";
        }
    }
?>

<html>
    <body>
        <form method="post">
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required><br>

            <label for="land">Land:</label>
            <input type="text" id="land" name="land" required><br>

            <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
        <a href='index.php'>Home</a>
    </body>
</html>

