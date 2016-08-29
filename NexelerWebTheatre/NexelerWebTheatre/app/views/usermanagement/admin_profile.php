<div class="page-body">
    <h1>Administratorski panel</h1>
    <br />
    <div style="width:100%">
    <form  action="<?php echo Config::get('ROOT'); ?>profile/editprofile" method="get">
        <table>

            <tr>
                <th>
                    <label>Ime:</label></th>
                <td>
                    <label><?php echo $data['admin']->name; ?></label></td>
            </tr>
            <tr>
                <th>
                    <label>Prezime:</label></th>
                <td>
                    <label><?php echo $data['admin']->last_name;; ?></label></td>
            </tr>
            <tr>
                <th>
                    <label>Korisnicko ime:</label></th>
                <td>
                    <label><?php echo $data['admin']->username; ?></label></td>
            </tr>
            <tr>
                <th>
                    <label>E-mail:</label></th>
                <td>
                    <label><?php echo $data['admin']->email; ?></label></td>
            </tr>
            <tr>
                <th>
                    <label>Sifra:</label></th>
                <td>
                    <label>**********</label></td>
            </tr>
            <tr>
                <th>
                    <label>Korisnicki profil:</label></th>
                <td>
                    <label><?php echo $data['admin']->user_type; ?></label></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button class="button">Promeni podatke</button></td>
            </tr>
        </table>
         </form>
            
        <table>
            <tr>
                <th>Statistika</th>
            </tr>
            <tr>
                <td>Moderatori</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Registrovani korisnici:</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Ulogovani korisnici:</td>
                <td>2</td>
            </tr>
        </table>
            </div>
   
  
        <h3>Registrovani useri</h3>
        <table>
            <tr>
                <td>Id</td>
                <td>Ime</td>
                <td>Prezime</td>
                <td></td>
            </tr>
            <?php 
                $users = $data['users'];
                foreach ($users as $key => $value) {
                ?>
            <tr>
                <td><?php echo $value['userID']; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['last_name']; ?></td>
                <td><button>unapredi</button><button>obrisi</button></td>
            </tr>

            <?php } ?>
        </table>
        <h3>Moderatori</h3>
           <table>
            <tr>
                <td>Id</td>
                <td>Ime</td>
                <td>Prezime</td>
                <td></td>
            </tr>
            <?php 
            $moderators = $data['moderators'];
            foreach ($moderators as $key => $value) {
            ?>
            <tr>
                <td><?php echo $value['userID']; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['last_name']; ?></td>
                <td><button>suspenduj</button><button>obrisi</button></td>
            </tr>
            <?php } ?>
        </table>



</div>
