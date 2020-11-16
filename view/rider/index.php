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

        echo '<tr><td>'.$rider["riderID"].'</td><td>'.$rider["riderName"].'</td>
<td>'.$rider["adress"].'</td><td>'.$rider["phoneNumber"].'</td><td><a href="edit/'.$rider["riderID"].'"><i class="fas fa-pen"></i></a> <a href="delete/'.$rider["riderID"].'"><i class="fas fa-trash"></i></a></td></tr>';





    }

    ?>
</table>