<h1>Paard aanmaken</h1>

<form action="<?= URL ?>rider/editStore" method="post">
    <div class="form-group">
        <label for="name">Naam</label>
        <input name="name" class="form-control" id="name" value="<?php if (isset($_SESSION["olDdata"]["name"])){echo $_SESSION["oldData"]["name"];} else {echo $data["riderName"];} ?>">
    </div>
    <div class="form-group">
        <label for="adress">Adres</label>
        <input name="adress" class="form-control" id="adress" value="<?php  if (isset($_SESSION["oldData"]["adress"])){echo $_SESSION["oldData"]["adress"];} else {echo $data["adress"];} ?>">
    </div>
    <div class="form-group">
        <label for="phonenumber">Telefoon nummer</label>
        <input name="phonenumber" class="form-control" id="phonenumber" value="<?php if (isset($_SESSION["oldData"]["phoneNumber"])){echo $_SESSION["oldData"]["phoneNumber"];} else {echo $data["phoneNumber"];} ?>">
    </div>
    <input class="hidden" name="id" value="<?php echo $data["riderID"]; ?>">
    <input class="btn btn-primary" type="submit">
</form>