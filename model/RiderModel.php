<?php

function getALlRiders()
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

        $stmt = $conn->prepare("SELECT * FROM `riders` WHERE RiderID = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $stmt->fetch();


}

function ValidateData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function createRider($name, $adress, $phonenumber)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("INSERT INTO `riders` (RiderID, RiderName, adress, phonenumber) VALUES (NULL, :name, :adress, :phonenumber)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":adress", $adress);
        $stmt->bindParam(":phonenumber", $phonenumber);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

}

function deleteRider($id)
{
    $data = getRider($id);
    $_SESSION["success"][] = "$data[RiderName] met ID $id was successvol verwijdered uit de database!";
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("DELETE FROM `riders` WHERE RiderID = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
    header("Location: ../index");
}

function updateRider($id, $name, $adress, $phonenumber)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("UPDATE `riders` SET `RiderName`=:name, `adress`=:adress, `phonenumber`=:phonenumber WHERE `RiderID`=:id");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":adress", $adress);
        $stmt->bindParam(":phonenumber", $phonenumber);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
}


?>