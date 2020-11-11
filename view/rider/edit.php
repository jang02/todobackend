<h1>Paard aanmaken</h1>

<form action="<?= URL ?>rider/editstore" method="post">
    <div class="form-group">
        <label for="name">Naam</label>
        <input name="name" class="form-control" id="name" value="<?php if (isset($_SESSION["olddata"]["name"])){echo $_SESSION["olddata"]["name"];} else {echo $data["RiderName"];} ?>">
    </div>
    <div class="form-group">
        <label for="adress">Adres</label>
        <input name="adress" class="form-control" id="adress" value="<?php  if (isset($_SESSION["olddata"]["adress"])){echo $_SESSION["olddata"]["adress"];} else {echo $data["adress"];} ?>">
    </div>
    <div class="form-group">
        <label for="phonenumber">Telefoon nummer</label>
        <input name="phonenumber" class="form-control" id="phonenumber" value="<?php if (isset($_SESSION["olddata"]["phonenumber"])){echo $_SESSION["olddata"]["phonenumber"];} else {echo $data["phonenumber"];} ?>">
    </div>
    <input class="hidden" name="id" value="<?php echo $data["RiderID"]; ?>">
    <input class="btn btn-primary" type="submit">
</form>