<?php

function getAllHorses()
{
    $db = openDatabaseConnection();

    $sql = "SELECT * FROM `horses`";
    $query = $db->prepare($sql);
    $query->execute();

    $db = null;

    return $query->fetchAll();
}

function getAllPlanned($date)
{
    $db = openDatabaseConnection();

    $sql = "SELECT id, TIME_FORMAT(startTime, '%H:%i') startTime, TIME_FORMAT(endTime, '%H:%i') endTime, horseName, ras, date 
FROM planning 
  INNER JOIN horses on horseID = horse_id
  WHERE Date=:date 
ORDER BY startTime ASC";
    $query = $db->prepare($sql);
    $query->bindParam(":date", $date);
    $query->execute();

    $db = null;

    return $query->fetchAll();
}

function horsePlanned($id, $date)
{
    try {
        $db = openDatabaseConnection();

        $sql = "SELECT TIME_FORMAT(startTime, '%H:%i') startTime, TIME_FORMAT(endTime, '%H:%i') endTime, horse_id, Date 
FROM planning 

  WHERE horse_id=:horseID AND Date=:date";
        $query = $db->prepare($sql);
        $query->bindParam(":horseID", $id);
        $query->bindParam(":date", $date);
        $query->execute();

        $db = null;

        return $query->fetchAll();
    } catch (PDOException $e) {
        return false;
    }
}

function getHorse($id)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("SELECT * FROM `horses` WHERE horseID = :id");
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

function createHorse($type, $name, $ras, $schofthoogte)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("INSERT INTO `horses` (horseID, type, horseName, ras, schofthoogte) VALUES (NULL, :type, :name, :ras, :schofthoogte)");
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":ras", $ras);
        $stmt->bindParam(":schofthoogte", $schofthoogte);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

}

function deleteHorse($id)
{
    $data = getHorse($id);
    $_SESSION["success"][] = "Successvol een $data[type] met de naam $data[horseName] verwijderd!";
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("DELETE FROM `horses` WHERE horseID = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
    header("Location: ../index");
}

function updateHorse($id, $type, $name, $ras, $schofthoogte)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("UPDATE `horses` SET `type`=:type, `horseName`=:name, `ras`=:ras, `schofthoogte`=:schofthoogte WHERE `horseID`=:id");
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":ras", $ras);
        $stmt->bindParam(":schofthoogte", $schofthoogte);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
}


?>