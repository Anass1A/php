<?php
// auteur: Vul hier je naam in
// functie: algemene functies tbv hergebruik

include_once "config.php";

function connectDb(){
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //echo "Connected successfully";
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function crudMain(){
    // Menu-item insert
    $txt = "
    <h1>Crud Brouwer</h1>
    <nav>
        <a href='insert.php'>Toevoegen nieuwe brouwer</a>
    </nav><br>";
    echo $txt;

    // Haal alle brouwer records uit de tabel 
    $result = getData(CRUD_TABLE);

    // Print table
    printCrudTabel($result);
}

// Selecteer de data uit de opgegeven tabel
function getData($table){
    $conn = connectDb();
    $sql = "SELECT * FROM $table";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

// Selecteer de rij van de opgegeven id uit de tabel brouwer
function getRecord($id){
    $conn = connectDb();
    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE brouwcode = :id";
    $query = $conn->prepare($sql);
    $query->execute([':id'=>$id]);
    $result = $query->fetch();

    return $result;
}

// Functie 'printCrudTabel' print een HTML-table met data uit $result en een wijzig- en verwijder-knop.
function printCrudTabel($result){
    $table = "<table>";

    // Print header table
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</tr>";

    // Print elke rij
    foreach ($result as $row) {
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }

        // Wijzig knopje
        $table .= "<td>
            <form method='get' action='update.php'>       
                <input type='hidden' name='id' value='{$row['brouwcode']}'>
                <button type='submit'>Wzg</button>	 
            </form></td>";

        // Delete knopje
        $table .= "<td>
            <form method='post' action='delete.php'>       
                <input type='hidden' name='id' value='{$row['brouwcode']}'>
                <button type='submit'>Verwijder</button>	 
            </form></td>";

        $table .= "</tr>";
    }
    $table .= "</table>";

    echo $table;
}

function updateRecord($row){
    $conn = connectDb();
    $sql = "UPDATE " . CRUD_TABLE . " 
    SET 
        naam = :naam, 
        land = :land
    WHERE brouwcode = :brouwcode";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam'=>$row['naam'],
        ':land'=>$row['land'],
        ':brouwcode'=>$row['brouwcode']
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false;
    return $retVal;
}

function insertRecord($post){
    $conn = connectDb();
    $sql = "
        INSERT INTO " . CRUD_TABLE . " (naam, land)
        VALUES (:naam, :land)
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam'=>$_POST['naam'],
        ':land'=>$_POST['land']
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false;
    return $retVal;
}

function deleteRecord($id){
    $conn = connectDb();
    $sql = "
    DELETE FROM " . CRUD_TABLE . " 
    WHERE brouwcode = :brouwcode";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':brouwcode'=>$id]);

    $retVal = ($stmt->rowCount() == 1) ? true : false;
    return $retVal;
}
?>
