<?php if (print_url(3) == 'kuesioner'): ?>
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
							<th>Kuesioner</th>
							<th>Pilihan A</th>
							<th>Pilihan B</th>
							<th>Pilihan C</th>
							<th>Pilihan D</th>
							<th>Total Responden</th>
						</tr>
					</thead>
					<tbody>
					<?php $no =1; ?> 
					<?php foreach ($list as $print): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $print->content ?></td>
						<td><?= $print->a.' ('.$print->pil_a.')' ?></td>
						<td><?= $print->b.' ('.$print->pil_b.')' ?></td>
						<td><?= $print->c.' ('.$print->pil_c.')' ?></td>
						<td><?= $print->d.' ('.$print->pil_d.')' ?></td>
						<td><?= $print->total ?></td>
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
							<th>Tanggal</th>
							<th>Email</th>
							<th>Nama</th>
							<th>Konten</th>
						</tr>
					</thead>
					<tbody>
					<?php $no =1; ?> 
					<?php foreach ($list as $print): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $print->date ?></td>
						<td><?= $print->email ?></td>
						<td><?= $print->nama ?></td>
						<td><?= $print->content ?></td>
					</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	
<?php endif ?>
