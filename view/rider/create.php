<h1>Rijder aanmaken</h1>

<form action="<?= URL ?>rider/store" method="post">
    <div class="form-group">
        <label for="name">Naam</label>
        <input name="name" class="form-control" id="name" value="<?php if (isset($_SESSION["oldData"]["name"])){echo $_SESSION["oldData"]["name"];} ?>">
    </div>
    <div class="form-group">
        <label for="adress">Adres</label>
        <input name="adress" class="form-control" id="adress" value="<?php if (isset($_SESSION["oldData"]["adress"])){echo $_SESSION["oldData"]["adress"];} ?>">
    </div>
    <div class="form-group">
        <label for="phoneNumber">Telefoon nummer</label>
        <input  name="phoneNumber" class="form-control" id="phoneNumber" value="<?php if (isset($_SESSION["oldData"]["phoneNumber"])){echo $_SESSION["oldData"]["phoneNumber"];} ?>">
    </div>
    <input class="btn btn-primary" type="submit">
</form>
