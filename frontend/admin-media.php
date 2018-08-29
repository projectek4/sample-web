<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Berkas Unggah</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<?= anchor('admin/unggah/'.print_url(3), fontawesome('plus').' Tambah Berkas', array('class'=>'btn btn-primary')); ?>
				<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Berkas</th>
							<th>Judul</th>
							<th>Tanggal Posting</th>
							<th>Format Data</th>
							<th class="text-right">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php $no =1; ?> 
					<?php foreach ($list as $print): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $print->media ?></td>
						<td><?= $print->title ?></td>
						<td><?= $print->date ?></td>
						<td><?= $print->format ?></td>
						<td class="text-right"><?= anchor('admin/delete/upload/'.$print->id, fontawesome('trash').' hapus', array('class'=>'btn btn-xs btn-danger')); ?> </td>
					</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
