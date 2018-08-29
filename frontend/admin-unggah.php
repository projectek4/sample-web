<?= form_open_multipart(current_url()); ?>
<?= form_hidden('url', print_url(3)) ?>
<?php if (print_url(3) == 'foto' OR print_url(3) == 'berkas'): ?>
<!-- type article -->
<?php if (print_url(3) == 'foto'): ?>
	<?= form_hidden('type', 'images') ?>
<?php else: ?>
	<?= form_hidden('type', 'file') ?>
<?php endif ?>
<div class="row">
	<div class="col-md-9">
		<div class="x_panel">
			<div class="x_title">
				<h2>Unggah <?= ucwords(print_url(3)) ?></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">Judul <?= print_url(3) ?>:</label>
					<div class="col-md-12">
						<?= form_input('title', set_value('title'), array('class'=>'form-control', 'placeholder'=>'Ketik judul ')) ?>
						<?= form_error('title') ?>
					</div>
				</div>
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">File <?= print_url(3) ?>:</label>
					<div class="col-md-12">
						<?= form_upload('file', set_value('file'), array('class'=>'form-control', 'placeholder'=>'Pilih file ')) ?>
						<?= form_error('file') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="x_panel">
			<div class="x_title">
				<h2>Aksi form</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="form-group"><div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-primary btn-block"><?= fontawesome('paper-plane') ?> Unggah foto</button></div></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php else: ?>
<div class="row">
	<div class="col-md-9">
		<div class="x_panel">
			<div class="x_title">
				<h2>Unggah <?= ucwords(print_url(3)) ?></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">Judul <?= print_url(3) ?>:</label>
					<div class="col-md-12">
						<?= form_input('title', set_value('title'), array('class'=>'form-control', 'placeholder'=>'Ketik judul ')) ?>
						<?= form_error('title') ?>
					</div>
				</div>
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">Alamat url video Youtube:</label>
					<div class="col-md-12">
						<?= form_input('media', set_value('media'), array('class'=>'form-control', 'placeholder'=>'Ketik judul ')) ?>
						<?= form_error('media') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="x_panel">
			<div class="x_title">
				<h2>Aksi form</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="form-group"><div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-primary btn-block"><?= fontawesome('paper-plane') ?> Unggah berkas</button></div></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>
<?= form_close(); ?>