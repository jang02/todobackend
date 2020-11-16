<h1><?php echo $data["type"]?> Verwijderen</h1>
<p>Weet u zeker dat u <span style="color: red"><?php echo $data["horseName"] ?></span> met het ras van <span style="color:red"><?php echo $data["ras"] ?></span> uit de database wilt verwijderen?</p>
<a href="<?=URL?>horse/destroy/<?php echo $data["horseID"]?>" class="btn btn-primary">Verwijderen</a>