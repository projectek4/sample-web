

<?php if (print_url(2) != 'video'): ?>
<div class="container">
	<div class="row">
		<?php foreach ($list as $print): ?>
		<div class="col-md-3">
			<a class="lightbox thumbnail" href="<?= base_url('assets/media/images/'.$print->media) ?>" data-littlelightbox-group="gallery" title="Flying is life">
				<img src="<?= base_url('assets/media/images/'.$print->media) ?>" alt="<?= $print->title ?>" />
			</a>
		</div>
		<?php endforeach ?>
	</div>
</div>
<?php else: ?>
<div class="container-fluid" style="margin-bottom: 40px">
	<div class="row">
		<?php foreach ($list as $print): ?>
		<div class="col-md-3">
		<div class="embed-responsive embed-responsive-4by3">
			<iframe class="embed-responsive-item" src="<?= $print->media ?>"></iframe>
		</div>
		</div>
		<?php endforeach ?>
	</div>
</div>
<?php endif ?>

