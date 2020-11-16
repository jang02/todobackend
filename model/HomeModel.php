<?php

function getAllPlanned($date)
{
    try {
        $db = openDatabaseConnection();

        $sql = "SELECT id, TIME_FORMAT(startTime, '%H:%i') startTime, TIME_FORMAT(endTime, '%H:%i') endTime, riderName, horseName, date 
FROM planning 
  INNER JOIN riders on riderID = rider_id 
  INNER JOIN horses on horseID = horse_id 
WHERE date=:date
ORDER BY startTime ASC";
        $query = $db->prepare($sql);
        $query->bindParam(":date", $date);
        $query->execute();

        $db = null;
    } catch (PDOException $e) {
        echo $e;
    }

    return $query->fetchAll();
}

function getAllHorses()
{
    $db = openDatabaseConnection();

    $sql = "SELECT * FROM `horses`";
    $query = $db->prepare($sql);
    $query->execute();

    $db = null;

    return $query->fetchAll();
}

function getAllRiders()
{
    $db = openDatabaseConnection();

    $sql = "SELECT * FROM `riders`";
    $query = $db->prepare($sql);
    $query->execute();

    $db = null;

    return $query->fetchAll();
}

function getIDRider($name)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("SELECT `riderID` FROM `riders` WHERE riderName = :name");
        $stmt->bindParam(":name", $name);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $stmt->fetch();
}

function getIDHorse($name)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("SELECT `horseID` FROM `horses` WHERE horseName = :name");
        $stmt->bindParam(":name", $name);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $stmt->fetch();
}

function getTimes($id, $option)
{
    if ($option === "rider") {
        try {
            $conn = openDatabaseConnection();

            $stmt = $conn->prepare("SELECT `startTime`,`endTime` FROM `planning` WHERE rider_id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

        } catch (PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }

        $conn = null;

        return $stmt->fetchAll();
    } else {
        try {
            $conn = openDatabaseConnection();

            $stmt = $conn->prepare("SELECT `startTime`,`endTime` FROM `planning` WHERE horse_id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

        } catch (PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }

        $conn = null;

        return $stmt->fetchAll();
    }
}

function getTimesUpdate($id, $entryID, $option)
{
    if ($option === "rider") {
        try {
            $conn = openDatabaseConnection();

            $stmt = $conn->prepare("SELECT `startTime`,`endTime` FROM `planning` WHERE rider_id = :id AND WHERE NOT id = :entryID");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":entryID", $entryID);
            $stmt->execute();

        } catch (PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }

        $conn = null;

        return $stmt->fetchAll();
    } else {
        try {
            $conn = openDatabaseConnection();

            $stmt = $conn->prepare("SELECT `startTime`,`endTime` FROM `planning` WHERE horse_id = :id AND WHERE NOT id = :entryID");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":entryID", $entryID);
            $stmt->execute();

        } catch (PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }

        $conn = null;

        return $stmt->fetchAll();
    }
}


function compareTime($time1, $time2, $time3, $time4, $type)
{
    if (strtotime($time1) < strtotime($time2) && strtotime($time3) < strtotime($time4)) {
        return true;
    } else {
        if ($type === "start") {
            if (strtotime($time1) >= strtotime($time2) && strtotime($time1) < strtotime($time3)) {
                return true;
            } else {
                return false;
            }
        } else {
            if (strtotime($time4) > strtotime($time2) && strtotime($time4) <= strtotime($time3)) {
                return true;
            } else {
                return false;
            }
        }
    }
}

function entry($id)
{
    $conn = openDatabaseConnection();

    $stmt = $conn->prepare("SELECT id, TIME_FORMAT(startTime, '%H:%i') startTime, TIME_FORMAT(endTime, '%H:%i') endTime, riderName, horseName, date 
FROM planning 
  INNER JOIN riders on riderID = rider_id 
  INNER JOIN horses on horseID = horse_id 
WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetch();
    $conn = null;
}

function createEntry($rider, $horse, $start, $end, $date)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("INSERT INTO `planning` (id, startTime, endTime, horse_id, rider_id, Date) VALUES (NULL, :start, :end, :horse, :rider, :date)");
        $stmt->bindParam(":start", $start);
        $stmt->bindParam(":end", $end);
        $stmt->bindParam(":horse", $horse);
        $stmt->bindParam(":rider", $rider);
        $stmt->bindParam(":date", $date);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
}

function updateEntry($rider, $horse, $start, $end, $id, $date)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("UPDATE planning SET `startTime`=:start, `endTime`=:end, `horse_id`=:horseID, `rider_id`=:riderID, `date`=:date WHERE `id`=:id");
        $stmt->bindParam(":start", $start);
        $stmt->bindParam(":end", $end);
        $stmt->bindParam(":horseID", $horse);
        $stmt->bindParam(":riderID", $rider);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
}

function deleteEntry($id)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("DELETE FROM `planning` WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();


    } catch (PDOException $e) {

        $_SESSION["error"][] = "Kon niet verwijderen uit de database, contact een admin";
    }
    $conn = null;
    $_SESSION["success"][] = "Successvol verwijdered uit de database!";
    header("Location: ../index");
}


