<?php

require(ROOT . "model/HomeModel.php");

// http://localhost/manege/home/index
function index()
{

    if (isset($_POST["date"])) {
        render("home/index", array(
            'planned' => getAllPlanned($_POST["date"])
        ));
    } else {
        $date = date('Y/m/d');
        render("home/index", array(
            'planned' => getAllPlanned($date)
        ));
    }

}

function plannen()
{

    render("home/plannen", array(
        'horse' => getAllHorses(),
        'rider' => getALlRiders()
    ));
}

function edit($id)
{
    render("home/edit", array(
        'horse' => getAllHorses(),
        'rider' => getALlRiders(),
        'entry' => entry($id)
    ));
}

function delete($id)
{
    $entry = entry($id);

    render("home/delete", $entry);
}

function store()
{
    $_SESSION["oldData"] = $_POST;
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    $idRider = getIDRider($_POST["rider"]);
    $idHorse = getIDHorse($_POST["horse"]);
    $date = $_POST["date"];
    $checker = [];

    if (!empty($startTime) && !empty($endTime)) {
        if (strtotime($startTime) > strtotime($endTime)) {
            $_SESSION["error"][] = "End time can't be smaller than start time";
            header("Location: plannen");
        } else {
            // start is eerder dan eindtijd

            if (strtotime($startTime) < strtotime("09:00:00") || strtotime($endTime) > strtotime("15:00:00")) {
                $_SESSION["error"][] = "Time must be between 9am and 3pm";
                header("Location: plannen");
            } else {

                foreach (getTimes($idRider["RiderID"], "rider") as $timesRider) {
                    if (compareTime($startTime, $timesRider["start_time"], $timesRider["end_time"], $endTime, "start") == false && compareTime($startTime, $timesRider["start_time"], $timesRider["end_time"], $endTime, "end") == false) {
                        array_push($checker, true);
                    } else {
                        $_SESSION["error"][] = "Rider is unavailable during your selected times";
                        array_push($checker, false);
                    }
                }
                foreach (getTimes($idHorse["HorseID"], "horse") as $timesHorse) {
                    if (compareTime($startTime, $timesHorse["start_time"], $timesHorse["end_time"], $endTime, "start") == false && compareTime($startTime, $timesHorse["start_time"], $timesHorse["end_time"], $endTime, "end") == false) {
                        array_push($checker, true);
                    } else {
                        $_SESSION["error"][] = "Horse is unavailable during your selected times";
                        array_push($checker, false);
                    }
                }
                if (in_array(false, $checker)) {
                    header("Location: plannen");
                } else {
                    createEntry($idRider["riderID"], $idHorse["horseID"], $startTime, $endTime, $date);
                    header("Location: index");
                }
            }

        }

    } else {
        $_SESSION["error"][] = "Time can't be empty";
        header("Location: plannen");
    }
}

function updateStore()
{
    $_SESSION["oldData"] = $_POST;
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    $idRider = getidRider($_POST["rider"]);
    $idHorse = getidHorse($_POST["horse"]);
    $entryID = $_POST["entryID"];
    $date = $_POST["date"];
    $checker = [];

    if (!empty($startTime) && !empty($endTime)) {
        if (strtotime($startTime) > strtotime($endTime)) {
            $_SESSION["error"][] = "End time can't be smaller than start time";
            header("Location: plannen");
        } else {
            // start is eerder dan eindtijd

            if (strtotime($startTime) < strtotime("09:00:00") || strtotime($endTime) > strtotime("15:00:00")) {
                $_SESSION["error"][] = "Time must be between 9am and 3pm";
                header("Location: update");
            } else {

                foreach (getTimesupdate($idRider["RiderID"], $entryID, "rider") as $timesRider) {
                    if (compareTime($startTime, $timesRider["start_time"], $timesRider["end_time"], $endTime, "start") ==
                        false && compareTime($startTime, $timesRider["start_time"], $timesRider["end_time"], $endTime, "end") == false) {
                        array_push($checker, true);
                    } else {
                        $_SESSION["error"][] = "Rider is unavailable during your selected times";
                        array_push($checker, false);
                    }
                }
                foreach (getTimesupdate($idHorse["HorseID"], $entryID, "horse") as $timesHorse) {
                    if (compareTime($startTime, $timesHorse["start_time"], $timesHorse["end_time"], $endTime, "start") ==
                        false && compareTime($startTime, $timesHorse["start_time"], $timesHorse["end_time"], $endTime, "end") == false) {
                        array_push($checker, true);
                    } else {
                        $_SESSION["error"][] = "Horse is unavailable during your selected times";
                        array_push($checker, false);
                    }
                }
                if (in_array(false, $checker)) {
                    header("Location: edit/" . $entryID . "");
                } else {
                    updateEntry($idRider["RiderID"], $idHorse["HorseID"], $startTime, $endTime, $entryID, $date);
                    $_SESSION["success"][] = "Successfully updated an entry";
                    header("Location: index");
                }
            }

        }

    } else {
        $_SESSION["error"][] = "Time can't be empty";
        header("Location: plannen");
    }
}

function destroy($id)
{
    deleteEntry($id);
}
