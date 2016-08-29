<div class="page-body">
    <h1>Administratorski panel</h1>
    <br />

    <table style="width: 80%">
        <h2>Registrovani korisnici</h2>
        <tr>
            <td>Id</td>
            <td>Ime</td>
            <td>Prezime</td>
        </tr>
            <?php 
            $users = $data['users'];
            foreach ($users as $key => $value) {
            ?>
        <tr>
            <td><?php echo $value['userID']; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['last_name']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <table style="width: 80%">
        <h2>Moderatori</h2>
        <tr>
            <td>Id</td>
            <td>Ime</td>
            <td>Prezime</td>
        </tr>
            <?php 
            $moderators = $data['moderators'];
            foreach ($moderators as $key => $value) {
            ?>
        <tr>
            <td><?php echo $value['userID']; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['last_name']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
