<div class="container">
	<table id="datatable" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th class="col-md-4">Nama File</th>
				<th class="col-md-1">Jenis</th>
				<th class="col-md-6">Penjelasan</th>
				<th class="col-md-1">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($list as $print): ?>
			<tr>
				<td><?= $print->title ?></td>
				<td><?= $print->format ?></td>
				<td><?= $print->keterangan ?></td>
				<td><?= anchor(uri_string().'/'.$print->media, 'Unduh Berkas', array('class'=>'btn btn-primary')) ?></td>
			</tr>	
			<?php endforeach ?>
		</tbody>
	</table>
</div>