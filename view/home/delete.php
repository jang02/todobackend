<h1>U gaat het volgende verwijderen</h1>
<table class="table">
    <tr>
        <th>Naam rijder</th>
        <th>Naam dier</th>
        <th>Start tijd</th>
        <th>Eind tijd</th>
        <th>Planning ID</th>
    </tr>
    <?php
    echo '<tr><td>' . $data["riderName"] . '</td><td>' . $data["horseName"] . '</td><td>' . $data["startTime"] . '</td><td>' . $data["endTime"] . '</td>
<td>' . $data["id"] . '</td></tr>';

    ?>
</table>
<a href="<?= URL ?>home/destroy/<?= $data["id"] ?>" class="btn btn-primary">Verwijderen</a>
