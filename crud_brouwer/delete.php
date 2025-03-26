<?php
    require_once('functions.php');

    // Controleer of het ID is meegegeven via POST (niet via GET, omdat we de POST-methode gebruiken in het formulier)
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Probeer het record te verwijderen met de opgegeven ID
        if (deleteRecord($id)) {
            echo "<script>alert('Brouwer is verwijderd')</script>";
            echo "<script>window.location.href = 'index.php';</script>"; // Redirect naar index na verwijderen
        } else {
            echo "<script>alert('Brouwer is NIET verwijderd')</script>";
        }
    } else {
        echo "Geen ID opgegeven om te verwijderen.";
    }
?>
