<h1>Inplannen</h1>

<form action="<?= URL ?>home/store" method="post">
    <div class="form-group">
        <label for="rider">Rijder</label>
        <select name="rider" class="form-control" id="rider">
            <?php
            foreach ($data["rider"] as $rider) {
                ?>

                <option <?php if (isset($_SESSION["olddata"]["rider"])) {
                    if ($_SESSION["olddata"]["rider"] == $rider["RiderName"]) {
                        echo 'selected="selected"';
                    }
                } ?>><?php echo $rider["RiderName"] ?></option>;

                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="horse">Naam Paard/Pony</label>
        <select name="horse" class="form-control" id="horse">
            <?php
            foreach ($data["horse"] as $horse) {
                ?>

                <option <?php if (isset($_SESSION["olddata"]["horse"])) {
                    if ($_SESSION["olddata"]["horse"] == $horse["HorseName"]) {
                        echo 'selected="selected"';
                    }
                } ?>><?php echo($horse["HorseName"]) ?></option>;

                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="start">Start tijd</label>
        <input type="time" name="start" class="form-control" id="start"
               value="<?php if (isset($_SESSION["olddata"]["start"])) {
                   echo $_SESSION["olddata"]["start"];
               } ?>">
    </div>
    <div class="form-group">
        <label for="end">Eind tijd</label>
        <input type="time" name="end" class="form-control" id="end"
               value="<?php if (isset($_SESSION["olddata"]["end"])) {
                   echo $_SESSION["olddata"]["end"];
               } ?>">
    </div>
    <div class="form-group">
        <label for="date">Datum</label>
        <input type="date" name="date" class="form-control" id="date"
               value="<?php if (isset($_SESSION["olddata"]["date"])) {
                   echo $_SESSION["olddata"]["date"];
               } ?>">
    </div>
    <input class="btn btn-primary" type="submit">
</form>