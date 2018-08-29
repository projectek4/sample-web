<?php if (print_url(3) == 'berita' OR print_url(3) == 'halaman' OR print_url(3) == 'agenda'): ?>
<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Artikel</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<?php if (print_url(3) == 'berita' OR print_url(3) == 'agenda'): ?>
					<?= anchor('admin/tambah/'.print_url(3), fontawesome('plus').' Tambah Artikel', array('class'=>'btn btn-primary')); ?>
				<?php endif ?>
				<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Judul Artikel</th>
							<th>Kategori</th>
							<th>Author</th>
							<th>Status</th>
							<th class="text-right">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php $no =1; ?> 
					<?php foreach ($list as $print): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $print->title ?></td>
						<td><?= str_replace('-', ' ', ucwords($print->category)) ?></td>
						<td><?= $print->author ?></td>
						<td><?=  ($print->active==1?'<span class="badge">publish</span>':'<span class="badge">draft</span>') ?></td>
						<td class="text-right"><?= anchor('admin/edit/'.print_url(3).'/'.$print->id, fontawesome('pencil').' edit', array('class'=>'btn btn-xs btn-info')); ?> <?= anchor('admin/delete/'.print_url(2).'/'.print_url(3).'/posting/'.$print->id, fontawesome('trash').' hapus', array('class'=>'btn btn-xs btn-danger')); ?> </td>
					</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php else: ?>	
<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Kategori</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<?= anchor('admin/tambah/kategori', fontawesome('plus').' Tambah Kategori', array('class'=>'btn btn-primary')); ?>
				<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Kategori</th>
							<th class="text-right">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php $no =1; ?> 
					<?php foreach ($list as $print): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $print->value ?></td>
						<td class="text-right"><?= anchor('admin/edit/kategori/'.$print->id, fontawesome('pencil').' edit', array('class'=>'btn btn-xs btn-info')); ?> <?= anchor('admin/delete/'.print_url(2).'/'.print_url(3).'/posting_category/'.$print->id, fontawesome('trash').' hapus', array('class'=>'btn btn-xs btn-danger')); ?> </td>
					</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif ?>
