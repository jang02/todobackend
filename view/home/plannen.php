<h1>Inplannen</h1>

<form action="<?= URL ?>home/store" method="post">
    <div class="form-group">
        <label for="rider">Rijder</label>
        <select name="rider" class="form-control" id="rider">
            <?php
            foreach ($data["rider"] as $rider) {
                ?>

                <option <?php if (isset($_SESSION["oldData"]["rider"])) {
                    if ($_SESSION["oldData"]["rider"] == $rider["riderName"]) {
                        echo 'selected="selected"';
                    }
                } ?>><?php echo $rider["riderName"] ?></option>;

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

                <option <?php if (isset($_SESSION["oldData"]["horse"])) {
                    if ($_SESSION["oldData"]["horse"] == $horse["horseName"]) {
                        echo 'selected="selected"';
                    }
                } ?>><?php echo($horse["horseName"]) ?></option>;

                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="startTime">Start tijd</label>
        <input type="time" name="startTime" class="form-control" id="startTime"
               value="<?php if (isset($_SESSION["oldData"]["start"])) {
                   echo $_SESSION["oldData"]["startTime"];
               } ?>">
    </div>
    <div class="form-group">
        <label for="endTime">Eind tijd</label>
        <input type="time" name="endTime" class="form-control" id="endTime"
               value="<?php if (isset($_SESSION["oldData"]["end"])) {
                   echo $_SESSION["oldData"]["endTime"];
               } ?>">
    </div>
    <div class="form-group">
        <label for="date">Datum</label>
        <input type="date" name="date" class="form-control" id="date"
               value="<?php if (isset($_SESSION["oldData"]["date"])) {
                   echo $_SESSION["oldData"]["date"];
               } ?>">
    </div>
    <input class="btn btn-primary" type="submit">
</form>