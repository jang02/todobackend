<h1>Paard aanmaken</h1>

<form action="<?= URL ?>horse/store" method="post">
    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" class="form-control" id="type">
            <option>Paard</option>
            <option>Pony</option>
        </select>
    </div>
    <div class="form-group">
        <label for="name">Naam</label>
        <input name="name" class="form-control" id="name" value="<?php if (isset($_SESSION["oldData"]["name"])){echo $_SESSION["oldData"]["name"];} ?>">
    </div>
    <div class="form-group">
        <label for="ras">Ras</label>
        <input name="ras" class="form-control" id="ras" value="<?php if (isset($_SESSION["oldData"]["ras"])){echo $_SESSION["oldData"]["ras"];} ?>">
    </div>
    <div class="form-group">
        <label for="schofthoogte">Schofthoogte</label>
        <input  name="schofthoogte" class="form-control" id="schofthoogte" value="<?php if (isset($_SESSION["oldData"]["schofthoogte"])){echo $_SESSION["oldData"]["schofthoogte"];} ?>">
    </div>
    <input class="btn btn-primary" type="submit">
</form>