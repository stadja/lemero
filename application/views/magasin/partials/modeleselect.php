<question>
	Pour finir, quel modèle ?
</question>
<select data-placeholder="Séléctionnez un modèle" style="width:350px;" tabindex="1" class="chosen-select" id="modeleSelect">
	<option value=""></option>
	<?php foreach ($modeles as $modele => $count): ?>
		<option value="<?php echo $modele?>"><?php echo humanize($modele).' ('.$count.')'; ?></option>
	<?php endforeach; ?>
</select>