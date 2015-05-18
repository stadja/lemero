
<div class="row">
	<div class="col-md-12">
		<div class="questionWrapper">
			<marque-selector>
				<question>
					Quelle marque recherchez vous ?
				</question>
				<select data-placeholder="Séléctionnez une marques" style="width:350px;" tabindex="1" class="chosen-select" id="marqueSelect">
					<option value=""></option>
					<?php foreach ($marques as $marque): ?>
						<option value="<?php echo urlencode(strtolower($marque->label)); ?>" <?php echo ($marque_selected == $marque->id) ? 'selected' : ''; ?>><?php echo humanize($marque->label).' ('.$marque->count.')'; ?></option>
					<?php endforeach; ?>
				</select>
			</marque-selector>
		</div>	
<!-- 		<div class="questionWrapper">
			<img class="loader" src='<?php echo site_url("assets/img/ajax-loader.gif"); ?>' id='annee-loader'/>
			<annee-selector></annee-selector>
		</div>
		<div class="questionWrapper">
			<img class="loader" src='<?php echo site_url("assets/img/ajax-loader.gif"); ?>' id='modele-loader'/>
			<modele-selector></modele-selector>
		</div> -->

	</div>
<!-- 	<div class="col-md-9">
		<img class="loader" src='<?php echo site_url("assets/img/ajax-loader.gif"); ?>' id='listing-loader'/>
		<listing-table></listing-table>
	</div> -->
</div>

<?php if ($crud_view): ?>
  <div class="row">
    <div class="col-md-12 ">
      <a name="liste" class="noDecoration bigger">Pièces <span class="brand"><?php echo $marque_label; ?></span></a>
      <?php echo $crud_view; ?>
    </div>
  </div>
<?php endif ?>

<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Intéressé par "<span class="piece-title"></span>" ?</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger" role="alert" style="display: none;">
	      	<button type="button" class="close" id="alert-close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	<span id="alert-text">test</span>
      	</div>
        <form>
          <div class="form-group">
            <label for="form-email" class="control-label">* Votre email:</label>
            <input type="email" class="form-control" id="form-email" required>
          </div>
          <div class="form-group">
            <label for="form-tel" class="control-label">Votre téléphone:</label>
            <input type="text" class="form-control" id="form-tel">
          </div>
          <div class="form-group">
            <label for="form-name" class="control-label">Votre Prénom / Nom:</label>
            <input type="text" class="form-control" id="form-name">
          </div>
          <div class="form-group">
            <label for="form-message" class="control-label">Un message complémentaire:</label>
            <textarea class="form-control" id="form-message"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary contactSend">Envoyer un message au vendeur</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
