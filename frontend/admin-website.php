<?php if (empty(print_url(3))): ?>
<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Website</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Tag Website</th>
							<th>Value</th>
							<th class="text-right">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php $no =1; ?> 
					<?php foreach ($list as $print): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $print->name ?></td>
						<td><?= $print->value ?></td>
						<td class="text-right"><?= anchor('admin/website/'.$print->id, fontawesome('pencil').' edit', array('class'=>'btn btn-xs btn-info')); ?></td>
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
<?= form_hidden('id', print_url(3)) ?>
<div class="row">
	<div class="col-md-9">
		<div class="x_panel">
			<div class="x_title">
				<h2>Edit Tag</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">Tag:</label>
					<div class="col-md-12">
						<?= form_input('name', $utama->name, array('class'=>'form-control', 'placeholder'=>'Ketik judul artikel')) ?>
						<?= form_error('name') ?>
					</div>
				</div>
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">value:</label>
					<div class="col-md-12">
						<?= form_textarea('value', $utama->value, array('class'=>'form-control')) ?>
						<?= form_error('value') ?>
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


	
