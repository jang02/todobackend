<h1><?= $data["type"]?> Verwijderen</h1>
<p>Weet u zeker dat u <span style="color: red"><?= $data["horseName"] ?></span> met het ras van <span style="color:red"><?= $data["ras"] ?></span> uit de database wilt verwijderen?</p>
<a href="<?=URL?>horse/destroy/<?= $data["horseID"]?>" class="btn btn-primary">Verwijderen</a>