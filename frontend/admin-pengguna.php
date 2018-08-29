<?php if (print_url(3) == 'daftar'): ?>
<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<?php if (print_url(3) == 'kuesioner'): ?>
					<h2>Hasil Kuesioner</h2>
				<?php else: ?>
					<h2>Kotak Saran</h2>
				<?php endif ?>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<!--<?= anchor('admin/unggah/'.print_url(3), fontawesome('plus').' Tambah Berkas', array('class'=>'btn btn-primary')); ?>-->
				<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Username</th>
							<th>Nama</th>
							<th>Level</th>
							<th class="text-right">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php $no =1; ?> 
					<?php foreach ($list as $print): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $print->username ?></td>
						<td><?= $print->nama ?></td>
						<td><?= ($print->level==1?'Administrator':'Admin UPT') ?></td>
						<td class="text-right"><?= anchor('admin/pengguna/'.$print->id, fontawesome('pencil').' edit', array('class'=>'btn btn-xs btn-info')); ?> <?= anchor('admin/pengguna/hapus/'.$print->id, fontawesome('pencil').' edit', array('class'=>'btn btn-xs btn-danger')); ?></td>
					</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php else: ?>
<?php foreach ($detail as $utama): ?>
<?= form_open(current_url()); ?>
<?= form_hidden('id', print_url(4)) ?>
<div class="row">
	<div class="col-md-9">
		<div class="x_panel">
			<div class="x_title">
				<h2>Edit Pengguna</h2>
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
						<?= form_input('password', '', array('class'=>'form-control', 'placeholder'=>'Ketik judul artikel')) ?>
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
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">Level:</label>
					<div class="col-md-12">
						<select class="form-control">
							<option value="2" <?= ($utama->level==2?'selected':'') ?>>Admin UPT</option>
							<option value="1" <?= ($utama->level==1?'selected':'') ?>>Administrator</option>
						</select>
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
<?php endif ?>


	
