<h1>Beschikbaarheid</h1>
<form action="<?= URL ?>horse/availability" method="post">
    <div class="form-group">
        <label for="rider">Datum</label>
        <input type="date" name="date" class="form">
        <input type="submit" class="btn btn-primary">
    </div>
</form>
<div id="dateWrapper">
    <form action="<?= URL ?>horse/availability" method="post">
        <input name="date" class="hidden" value="<?php $date = $data["horse"][0]["Date"];
        $date = strtotime($date);
        $date = strtotime("-1 day", $date);
        echo date('Y-m-d', $date); ?>">
        <?php
        if (isset($data["horse"][0]["Date"])) {
            echo '<input type="submit" class="btn btn-primary" value="Vorige">';
        }
        ?>
    </form>
    <?php
    if (isset($data["horse"][0]["Date"])) {
        echo '<p>' . $data["horse"][0]["Date"] . '</p>';
    }
    ?>
    <form action="<?= URL ?>horse/availability" method="post">
        <input name="date" class="hidden" value="<?php $date = $data["horse"][0]["Date"];
        $date = strtotime($date);
        $date = strtotime("+1 day", $date);
        echo date('Y-m-d', $date); ?>">
        <?php
        if (isset($data["horse"][0]["Date"])) {
            echo '<input type="submit" class="btn btn-primary" value="Volgende">';
        }
        ?>
    </form>
</div>
<table class="table">
    <tr>
        <th>Ras</th>
        <th>Naam</th>
        <th>Planned</th>
        <th>9-10</th>
        <th>10-11</th>
        <th>11-12</th>
        <th>12-13</th>
        <th>13-14</th>
        <th>14-15</th>
    </tr>
    <?php
    $i = 0;
    foreach ($data["horse"] as $horse) {
        echo '<tr><td>' . $horse["type"] . '</td><td>' . $horse["HorseName"] . '</td><td>' . $data["boolean"][$i] . '</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
        $i++;
    }

    ?>
</table>