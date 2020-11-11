<?php

function getAllPlanned($date)
{
    try {
        $db = openDatabaseConnection();

        $sql = "SELECT id, TIME_FORMAT(start_time, '%H:%i') start_time, TIME_FORMAT(end_time, '%H:%i') end_time, RiderName, HorseName, Date 
FROM planning 
  INNER JOIN riders on RiderID = Rider_id 
  INNER JOIN horses on HorseID = Horse_id 
WHERE Date=:date
ORDER BY start_time ASC";
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

function getALlRiders()
{
    $db = openDatabaseConnection();

    $sql = "SELECT * FROM `riders`";
    $query = $db->prepare($sql);
    $query->execute();

    $db = null;

    return $query->fetchAll();
}

function getIDrider($name)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("SELECT `RiderID` FROM `riders` WHERE RiderName = :name");
        $stmt->bindParam(":name", $name);
        $stmt->execute();

    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $stmt->fetch();
}

function getIDhorse($name)
{
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("SELECT `HorseID` FROM `horses` WHERE HorseName = :name");
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

            $stmt = $conn->prepare("SELECT `start_time`,`end_time` FROM `planning` WHERE Rider_id = :id");
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

            $stmt = $conn->prepare("SELECT `start_time`,`end_time` FROM `planning` WHERE Horse_id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

        } catch (PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }

        $conn = null;

        return $stmt->fetchAll();
    }
}

function getTimesupdate($id, $entryid, $option)
{
    if ($option === "rider") {
        try {
            $conn = openDatabaseConnection();

            $stmt = $conn->prepare("SELECT `start_time`,`end_time` FROM `planning` WHERE Rider_id = :id AND WHERE NOT id = :entryid");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":entryid", $entryid);
            $stmt->execute();

        } catch (PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }

        $conn = null;

        return $stmt->fetchAll();
    } else {
        try {
            $conn = openDatabaseConnection();

            $stmt = $conn->prepare("SELECT `start_time`,`end_time` FROM `planning` WHERE Horse_id = :id AND WHERE NOT id = :entryid");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":entryid", $entryid);
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

    $stmt = $conn->prepare("SELECT id, TIME_FORMAT(start_time, '%H:%i') start_time, TIME_FORMAT(end_time, '%H:%i') end_time, RiderName, HorseName, Date 
FROM planning 
  INNER JOIN riders on RiderID = Rider_id 
  INNER JOIN horses on HorseID = Horse_id 
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

        $stmt = $conn->prepare("INSERT INTO `planning` (id, start_time, end_time, Horse_id, Rider_id, Date) VALUES (NULL, :start, :end, :horse, :rider, :date)");
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

        $stmt = $conn->prepare("UPDATE planning SET `start_time`=:start, `end_time`=:end, `Horse_id`=:horseid, `Rider_id`=:riderid, `Date`=:date WHERE `id`=:id");
        $stmt->bindParam(":start", $start);
        $stmt->bindParam(":end", $end);
        $stmt->bindParam(":horseid", $horse);
        $stmt->bindParam(":riderid", $rider);
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


