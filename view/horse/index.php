<h1>Paarden</h1>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Naam</th>
        <th>Ras</th>
        <th>schofthoogte</th>
        <th></th>
    </tr>
    <?php
    foreach ($data["horse"] as $horse) {
    ?>
    <tr>
        <td><?=$horse["horseID"] ?></td>
        <td><?=$horse["type"] ?></td>
        <td><?=$horse["horseName"] ?></td>
        <td><?=$horse["ras"] ?></td>
        <td><?=$horse["schofthoogte"] ?></td>
        <td>
            <a href="edit/<?=$horse["horseID"] ?>"><i class="fas fa-pen"></i></a>
            <a href="delete/<?=$horse["horseID"] ?>"><i class="fas fa-trash"></i></a>
        </td>
    </tr>

<?php
}
?>