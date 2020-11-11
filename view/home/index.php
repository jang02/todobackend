<h1>Planning</h1>
<form action="<?= URL ?>home/index" method="post">
    <div class="form-group">
        <label for="rider">Datum</label>
        <input type="date" name="date" class="form">
        <input type="submit" class="btn btn-primary">
    </div>
</form>
<div id="dateWrapper">
    <form action="<?= URL ?>home/index" method="post">
        <input name="date" class="hidden" value="<?php $date = $data["planned"][0]["Date"];
        $date = strtotime($date);
        $date = strtotime("-1 day", $date);
        echo date('Y-m-d', $date); ?>">
        <?php
        if (isset($data["planned"][0]["Date"])) {
            echo '<input type="submit" class="btn btn-primary" value="Vorige">';
        }
        ?>
    </form>
    <?php
    if (isset($data["planned"][0]["Date"])) {
        echo '<p>' . $data["planned"][0]["Date"] . '</p>';
    }
    ?>
    <form action="<?= URL ?>home/index" method="post">
        <input name="date" class="hidden" value="<?php $date = $data["planned"][0]["Date"];
        $date = strtotime($date);
        $date = strtotime("+1 day", $date);
        echo date('Y-m-d', $date); ?>">
        <?php
        if (isset($data["planned"][0]["Date"])) {
            echo '<input type="submit" class="btn btn-primary" value="Volgende">';
        }
        ?>
    </form>
</div>
<table class="table">
    <tr>
        <th scope="col">Naam rijder</th>
        <th scope="col">Naam dier</th>
        <th scope="col">Start tijd</th>
        <th scope="col">Eind tijd</th>
        <th scope="col">Planning ID</th>
    </tr>
    <?php
    if (isset($data["planned"][0]["Date"])) {
        foreach ($data["planned"] as $planned) {
            echo '<tr><td>' . $planned["RiderName"] . '</td><td>' . $planned["HorseName"] . '</td><td>' . $planned["start_time"] . '</td><td>' . $planned["end_time"] . '</td>
<td>' . $planned["id"] . '</td><td>' . $planned["Date"] . '<a href="edit/' . $planned["id"] . '"><i class="fas fa-pen"></i></a> <a href="delete/' . $planned["id"] . '"><i class="fas fa-trash"></i></a></td></tr>';
        }
    } else {
        echo "No date found in database";
    }


    ?>
</table>