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
    echo '<tr><td>' . $data["RiderName"] . '</td><td>' . $data["HorseName"] . '</td><td>' . $data["start_time"] . '</td><td>' . $data["end_time"] . '</td>
<td>' . $data["id"] . '</td></tr>';

    ?>
</table>
<a href="<?= URL ?>home/destroy/<?php echo $data["id"] ?>" class="btn btn-primary">Verwijderen</a>
