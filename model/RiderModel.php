<?php

function getAllRiders()
{
    $db = openDatabaseConnection();

    $sql = "SELECT * FROM `riders`";
    $query = $db->prepare($sql);
    $query->execute();

    $db = null;

    return $query->fetchAll();
}

function getRider($id)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("SELECT * FROM `riders` WHERE riderID = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $stmt->fetch();


}

function validateData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function createRider($name, $adress, $phoneNumber)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("INSERT INTO `riders` (riderID, riderName, adress, phoneNumber) VALUES (NULL, :name, :adress, :phoneNumber)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":adress", $adress);
        $stmt->bindParam(":phoneNumber", $phoneNumber);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

}

function deleteRider($id)
{
    $data = getRider($id);
    $_SESSION["success"][] = "$data[riderName] met ID $id was successvol verwijdered uit de database!";
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("DELETE FROM `riders` WHERE riderID = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
    header("Location: ../index");
}

function updateRider($id, $name, $adress, $phoneNumber)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("UPDATE `riders` SET `riderName`=:name, `adress`=:adress, `phoneNumber`=:phoneNumber WHERE `riderID`=:id");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":adress", $adress);
        $stmt->bindParam(":phoneNumber", $phoneNumber);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
}


?>