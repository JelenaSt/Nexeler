<div class="page-body" style="height:100%">

    <h1>Kontakt informacije:</h1>

	<?php
	header("Content-Type: text/html;charset=utf-8");
	if (Session::get('user_level') == 2)
	{
	?>
	<td>
		<form id="contact-form" action="<?php echo Config::get('ROOT'); ?>contact/edit" method="link">
			<button class="button" style="float: right;">Izmeni</button>  
		</form>
	</td>
	<?php 
	} ?>
	
	<br/>
	<br/>
	<br/>
	
	<table style="width: 80%">
            <col width="50%">
            <col width="50%">
	
		<?php 
		if (!empty($data['contact']->president))
		{ ?>
			<tr>	
				<th><label>Direktor:</label></th>
				<td><?php echo $data['contact']->president; ?></td>
			</tr>
		<?php 
		} 
		if (!empty($data['contact']->vicePresident))
		{ ?>	
			<tr>	
				<th><label>Zamenik direktora:</label></th>
				<td><?php echo $data['contact']->vicePresident; ?></td>
			</tr>
		<?php
		}
		if (!empty($data['contact']->prmanager))
		{ ?>
			<tr>	
				<th><label>PR menadzer:</label></th>
				<td><?php echo $data['contact']->prmanager; ?></td>
			</tr>
		<?php 
		}
		if (!empty($data['contact']->phone1)||!empty($data['contact']->phone2)||!empty($data['contact']->phone3)) 
		{ 
			$phoneNumbers = "";
			$telIndex = 0;
			if (!empty($data['contact']->phone1))
			{
				$phoneNumbers.= $data['contact']->phone1;
				$telIndex+=1;
			}
			if (!empty($data['contact']->phone2))
			{
				if ($telIndex != 0) $phoneNumbers.= '<br>';
				$phoneNumbers.= $data['contact']->phone2;
				$telIndex+=1;
			}
			if (!empty($data['contact']->phone3))
			{
				if ($telIndex != 0) $phoneNumbers.= '<br>';
				$phoneNumbers.= $data['contact']->phone3;
			} ?>
			
			<tr>	
				<th><label>Telefon:</label></th>
				<td><?php echo "$phoneNumbers"; ?></td>
			</tr>
			
		<?php 
		} 
		if (!empty($data['contact']->fax)) 
		{ ?>
			<tr>	
				<th><label>Fax:</label></th>
				<td><?php echo $data['contact']->fax; ?></td>
			</tr>
		<?php 
		}
		if (!empty($data['contact']->email)) 
		{ ?>
			<tr>	
				<th><label>E-mail:</label></th>
				<td><?php echo $data['contact']->email; ?></td>
			</tr>
		<?php
		}
		if (!empty($data['contact']->address)) 
		{ ?>
			<tr>	
				<th><label>Adresa:</label></th>
				<td><?php echo $data['contact']->address; ?></td>
			</tr>

		<?php
		} ?>
	</table>
</div>
