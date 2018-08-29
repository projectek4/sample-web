<?php foreach ($detail as $utama): ?>
<?= form_open(current_url()); ?>
<div class="row">
	<div class="col-md-9">
		<div class="x_panel">
			<div class="x_title">
				<h2>Edit Profil</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">Username:</label>
					<div class="col-md-12">
						<?= form_input('username', $utama->username, array('class'=>'form-control', 'placeholder'=>'Ketik judul artikel')) ?>
						<?= form_error('username') ?>
					</div>
				</div>
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">Password:</label>
					<div class="col-md-12">
						<?= form_password('password', '', array('class'=>'form-control')) ?>
						<?= form_error('password') ?>
					</div>
				</div>
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">Nama:</label>
					<div class="col-md-12">
						<?= form_input('nama', $utama->nama, array('class'=>'form-control', 'placeholder'=>'Ketik judul artikel')) ?>
						<?= form_error('nama') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	<div class="col-md-3">
		<div class="x_panel">
			<div class="x_title">
				<h2>Aksi Form</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="form-group"><div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-primary btn-block"><?= fontawesome('paper-plane') ?> Simpan Data</button></div></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= form_close(); ?>

		
<?php endforeach ?>
