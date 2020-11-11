<h1>Paard aanmaken</h1>

<form action="<?= URL ?>horse/editstore" method="post">
    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" class="form-control" id="type" value="Pony">
            <?php
            if($data["type"] === "Paard"){
                echo "<option selected='selected'>Paard</option>
            <option>Pony</option>";
            }
            else{
                echo "<option>Paard</option>
            <option selected='selected'>Pony</option>";
            } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="name">Naam</label>
        <input name="name" class="form-control" id="name" value="<?php if (isset($_SESSION["olddata"]["name"])){echo $_SESSION["olddata"]["name"];} else {echo $data["HorseName"];} ?>">
    </div>
    <div class="form-group">
        <label for="ras">Ras</label>
        <input name="ras" class="form-control" id="ras" value="<?php  if (isset($_SESSION["olddata"]["ras"])){echo $_SESSION["olddata"]["ras"];} else {echo $data["ras"];} ?>">
    </div>
    <div class="form-group">
        <label for="schofthoogte">Schofthoogte</label>
        <input name="schofthoogte" class="form-control" id="schofthoogte" value="<?php if (isset($_SESSION["olddata"]["schofthoogte"])){echo $_SESSION["olddata"]["schofthoogte"];} else {echo $data["schofthoogte"];} ?>">
    </div>
    <input class="hidden" name="id" value="<?php echo $data["HorseID"]; ?>">
    <input class="btn btn-primary" type="submit">
</form>