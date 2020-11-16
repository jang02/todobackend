<?php

require(ROOT . "model/RiderModel.php");

function index()
{
    render("rider/index", array(
        'rider' => getALlRiders()
    ));
}

function create()
{
    render("rider/create");
}

function edit($id)
{
    $rider = getRider($id);
    render("rider/edit", $rider);
}

function delete($id)
{

    $rider = getRider($id);

    render("rider/delete", $rider);
}

function store()
{
    $name = ValidateData($_POST["name"]);
    $adress = ValidateData($_POST["adress"]);
    $phoneNumber = ValidateData($_POST["phoneNumber"]);


    if ($name == "" || $adress == "" || !is_numeric($phoneNumber)) {
        if ($name == "") {
            $_SESSION["error"][] = "Vul een naam in";
        }
        if ($adress == "") {
            $_SESSION["error"][] = "Vul een adres in";
        }
        if ($phoneNumber == "") {
            $_SESSION["error"][] = "Vul een telefoon nummer in";
        } else if (!is_numeric($phoneNumber)) {
            $_SESSION["error"][] = "u kunt alleen nummers invoeren bij telefoon nummer";
        }
        $_SESSION["oldData"] = $_POST;
        header("Location: create");
    } else {
        createRider($name, $adress, $phoneNumber);
        $_SESSION["success"][] = "Successvol een rijder met de naam $name Toegevoegd!";
        header("Location: index");
    }

}

function destroy($id)
{
    deleteRider($id);
}

function editStore()
{
    $id = ValidateData($_POST["id"]);
    $name = ValidateData($_POST["name"]);
    $adress = ValidateData($_POST["adress"]);
    $phoneNumber = ValidateData($_POST["phoneNumber"]);

    if ($name == "" || $adress == "" || !is_numeric($phoneNumber)) {
        if ($name == "") {
            $_SESSION["error"][] = "Vul een naam in";
        }
        if ($adress == "") {
            $_SESSION["error"][] = "Vul een adres in";
        }
        if ($phoneNumber == "") {
            $_SESSION["error"][] = "Vul een telefoon nummer in";
        } else if (!is_numeric($phoneNumber)) {
            $_SESSION["error"][] = "u kunt alleen nummers invoeren bij telefoon nummer";
        }
        $_SESSION["oldData"] = $_POST;
        header("Location: edit/$id");
    } else {
        updateRider($id, $name, $adress, $phoneNumber);
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