<div class="page-body" style="height:100%">

    <h1>Kontakt informacije:</h1>
	<br/>
	
	<form  action="<?php echo Config::get('ROOT'); ?>contact/update_info" method="post" enctype="multipart/form-data">
	<table style="width: 80%">
            <col width="50%">
            <col width="50%">
		<tr>	
			<th><label>Direktor:</label></th>
			<td><input type="text" name="president" value="<?php if (!empty($data['contact']->president)) echo $data['contact']->president;?>"/></td>
		</tr>	
		<tr>	
			<th><label>Zamenik direktora:</label></th>
			<td><input type="text" name="vicePresident" value="<?php if (!empty($data['contact']->vicePresident)) echo $data['contact']->vicePresident; ?>"/></td>
		</tr>	
		<tr>	
			<th><label>PR menadzer:</label></th>
			<td><input type="text" name="prmanager" value="<?php if (!empty($data['contact']->prmanager)) echo $data['contact']->prmanager;?>"/></td>
		</tr>	
		<tr>	
			<th><label>Telefon 1:</label></th>
			<td><input type="text" name="phone1" value="<?php if (!empty($data['contact']->phone1))echo $data['contact']->phone1; ?>"/></td>
		</tr>		
		<tr>	
			<th><label>Telefon 2:</label></th>
			<td><input type="text" name="phone2" value="<?php if (!empty($data['contact']->phone2))echo $data['contact']->phone2;?>"/></td>
		</tr>
		<tr>	
			<th><label>Telefon 3:</label></th>
			<td><input type="text" name="phone3" value="<?php if (!empty($data['contact']->phone3)) echo $data['contact']->phone3;?>"/></td>
		</tr>
		<tr>	
			<th><label>Fax:</label></th>
			<td><input type="text" name="fax" value="<?php if (!empty($data['contact']->fax)) echo $data['contact']->fax;?>"/></td>
		</tr>
		<tr>	
			<th><label>E-mail:</label></th>
			<td><input type="text" name="email" value="<?php if (!empty($data['contact']->email)) echo $data['contact']->email;?>"/></td>
		</tr>
		<tr>	
			<th><label>Adresa:</label></th>
			<td><textarea name="address" rows="4" cols="80"><?php if (!empty($data['contact']->address)) echo $data['contact']->address;?></textarea></td>
		</tr>
		<tr>
			<th><button class="cancel-button" formaction="<?php echo Config::get('ROOT') . 'contact/info';?>" >Odustani</button></th>
			<td><button class="button">Promeni podatke</button></td>
		</tr>
	</table>
</div>