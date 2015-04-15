<div class="row">
	<?php foreach ($pieces as $piece): ?>
		<div class="col-sm-6 col-md-4">
        <div class="thumbnail">
        <a class="fancybox" rel="group-<?php echo $piece->id; ?>" href="<?php echo site_url('assets/uploads/files/'.$piece->image1); ?>"><img class='thumbnailImage' src="<?php echo site_url('assets/uploads/files/'.$piece->image1); ?>" alt="" data-holder-rendered="true" style="display: block;"/></a>
		<?php if($piece->image2): ?>
			<a class="fancybox" rel="group-<?php echo $piece->id; ?>" href="<?php echo site_url('assets/uploads/files/'.$piece->image2); ?>"><img src="<?php echo site_url('assets/uploads/files/'.$piece->image2); ?>" alt="" data-holder-rendered="true" style="display: none;"/></a>
		<?php endif; ?>
		<?php if($piece->image3): ?>
			<a class="fancybox" rel="group-<?php echo $piece->id; ?>" href="<?php echo site_url('assets/uploads/files/'.$piece->image3); ?>"><img src="<?php echo site_url('assets/uploads/files/'.$piece->image3); ?>" alt="" data-holder-rendered="true" style="display: none;"/></a>
		<?php endif; ?>
          <div class="caption">
            <h3><?php echo $piece->label; ?></h3>
            <p><?php if($piece->annee_debut): ?>
						<?php echo ($piece->annee_fin ? $piece->annee_debut.' / '.$piece->annee_fin: $piece->annee_debut); ?>
					<?php endif; ?>
					<?php if($piece->etat): ?>
						<br/><?php echo $piece->etat; ?>
					<?php endif; ?>
					<br/><strong><?php echo $piece->prix; ?>€</strong><?php echo ($piece->prix_unitaire ? ' (prix unitaire)' : ''); ?><?php echo ($piece->port_inclus ? ' - frais de ports inclus' : ' + frais de ports à ajouter'); ?>
					</p>
            <p><a href="#" class="btn btn-primary contact" role="button" data-toggle="modal" data-target="#contactModal" data-id="<?php echo $piece->id; ?>" data-title="<?php echo $piece->label; ?>">Contacter le vendeur</a></p>
          </div>
        </div>
      </div>

	<?php endforeach ?>
</div>

