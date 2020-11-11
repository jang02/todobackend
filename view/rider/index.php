<h1>Rijders</h1>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Adres</th>
        <th>Telefoon nummber</th>
        <th></th>
    </tr>
    <?php
    foreach ($data["rider"] as $rider) {

        echo '<tr><td>'.$rider["RiderID"].'</td><td>'.$rider["RiderName"].'</td>
<td>'.$rider["adress"].'</td><td>'.$rider["phonenumber"].'</td><td><a href="edit/'.$rider["RiderID"].'"><i class="fas fa-pen"></i></a> <a href="delete/'.$rider["RiderID"].'"><i class="fas fa-trash"></i></a></td></tr>';





    }

    ?>
</table>