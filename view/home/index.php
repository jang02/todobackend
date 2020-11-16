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
        <input name="date" class="hidden" value="<?php $date = $data["planned"][0]["date"];
        $date = strtotime($date);
        $date = strtotime("-1 day", $date);
        echo date('Y-m-d', $date); ?>">
        <?php
        if (isset($data["planned"][0]["date"])) {
            echo '<input type="submit" class="btn btn-primary" value="Vorige">';
        }
        ?>
    </form>
    <?php
    if (isset($data["planned"][0]["date"])) {
        echo '<p>' . $data["planned"][0]["date"] . '</p>';
    }
    ?>
    <form action="<?= URL ?>home/index" method="post">
        <input name="date" class="hidden" value="<?php $date = $data["planned"][0]["date"];
        $date = strtotime($date);
        $date = strtotime("+1 day", $date);
        echo date('Y-m-d', $date); ?>">
        <?php
        if (isset($data["planned"][0]["date"])) {
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
        <th scope="col">Datum</th>
    </tr>
    <?php
    if (isset($data["planned"][0]["date"])) {
        foreach ($data["planned"] as $planned) {
            ?>
            <tr>
                <td><?= $planned["riderName"] ?></td>
                <td><?= $planned["horseName"] ?></td>
                <td><?= $planned["startTime"] ?></td>
                <td><?= $planned["endTime"] ?></td>
                <td><?= $planned["id"] ?></td>
                <td><?= $planned["date"] ?></td>
                <td>
                    <a href="edit/<?= $planned["id"] ?>"><i class="fas fa-pen"></i></a>
                    <a href="delete/<?= $planned["id"] ?>"><i class="fas fa-trash"></i></a>
                </td>
            </tr>

            <?php
        }
    } else{
        echo "No date found in database";
    }
    ?>
</table>

