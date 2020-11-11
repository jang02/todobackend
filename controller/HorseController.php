<?php

require(ROOT . "model/HorseModel.php");

function index()
{
    render("horse/index", array(
        'horse' => getAllHorses()
    ));
}

function create()
{
    render("horse/create");
}

function availability()
{
    $horses = getAllHorses();
    $date = null;
    $horsecheck = array();
    if (isset($_POST["date"])) {
        $date = date($_POST["date"]);
    } else {
        $date = date('Y/m/d');
    }
    foreach ($horses as $horse) {
        if (horsePlanned($horse["HorseID"], $date)) {
            echo "true";
            array_push($horsecheck, "ja");
        } else {
            echo "false";
            array_push($horsecheck, "nee");
        }
    }
    render("horse/availability", array(
        'boolean' => $horsecheck,
        'horse' => $horses
    ));

}

function edit($id)
{
    $horse = getHorse($id);
    render("horse/edit", $horse);
}

function delete($id)
{

    $horse = getHorse($id);

    render("horse/delete", $horse);
}

function store()
{
    $type = ValidateData($_POST["type"]);
    $name = ValidateData($_POST["name"]);
    $ras = ValidateData($_POST["ras"]);
    $schofthoogte = ValidateData($_POST["schofthoogte"]);

    if ($type == "" || $name == "" || $ras == "" || tofloat($schofthoogte) <= 0 || tofloat($schofthoogte) > 3) {
        if ($name == "") {
            $_SESSION["error"][] = "Vul een naam in";
        }
        if ($ras == "") {
            $_SESSION["error"][] = "Vul een ras in";
        }
        if ($schofthoogte == "") {
            $_SESSION["error"][] = "Vul een schofthoogte in";
        } else if (tofloat($schofthoogte) <= 0 || tofloat($schofthoogte) > 3) {
            $_SESSION["error"][] = "Schofthoogte moet groter dan 0 en kleiner of gelijk aan 3 zijn";
        }
        $_SESSION["olddata"] = $_POST;
        header("Location: create");
    } else {
        createHorse($type, $name, $ras, tofloat($schofthoogte));
        $_SESSION["success"][] = "Successvol een $type met de naam $name Toegevoegd!";
        header("Location: index");
    }

}

function destroy($id)
{
    deleteHorse($id);
}

function editstore()
{
    $id = $type = $name = $ras = $schofthoogte = "";
    $id = ValidateData($_POST["id"]);
    $type = ValidateData($_POST["type"]);
    $name = ValidateData($_POST["name"]);
    $ras = ValidateData($_POST["ras"]);
    $schofthoogte = ValidateData($_POST["schofthoogte"]);

    if ($type == "" || $name == "" || $ras == "" || tofloat($schofthoogte) <= 0 || tofloat($schofthoogte) > 3) {
        if ($name == "") {
            $_SESSION["error"][] = "Vul een naam in";
        }
        if ($ras == "") {
            $_SESSION["error"][] = "Vul een ras in";
        }
        if ($schofthoogte == "") {
            $_SESSION["error"][] = "Vul een schofthoogte in";
        } else if (tofloat($schofthoogte) <= 0 || tofloat($schofthoogte) > 3) {
            $_SESSION["error"][] = "Schofthoogte moet groter dan 0 en kleiner of gelijk aan 3 zijn";
        }
        $_SESSION["olddata"] = $_POST;
        header("Location: edit/$id");
    } else {
        updateHorse($id, $type, $name, $ras, tofloat($schofthoogte));
        $_SESSION["success"][] = "Successvol het ID $id aangepast!";
        header("Location: index");
    }

}


function tofloat($num)
{
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num));
    }

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
        preg_replace("/[^0-9]/", "", substr($num, $sep + 1, strlen($num)))
    );
}