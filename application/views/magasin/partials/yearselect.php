<question>
	De quelle année ?
</question>
<select data-placeholder="Séléctionnez une année" style="width:350px;" tabindex="1" class="chosen-select" id="yearSelect">
	<option value=""></option>
	<?php foreach ($years as $year => $count): ?>
		<option value="<?php echo $year?>"><?php echo ($year ?: 'Toutes années' ).' ('.$count.')'; ?></option>
	<?php endforeach; ?>
</select>