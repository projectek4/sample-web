<?php foreach ($detail as $utama): ?>
	
<?= form_open(current_url()); ?>
<?= form_hidden('id', print_url(4)) ?>
<?php if (print_url(3) == 'berita' OR print_url(3) == 'halaman'): ?>
<!-- type article -->
<?= form_hidden('type', 'article') ?>
<?= form_hidden('url', print_url(3)) ?>
<div class="row">
	<div class="col-md-9">
		<div class="x_panel">
			<div class="x_title">
				<h2>Kontent Berita</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">Judul Berita:</label>
					<div class="col-md-12">
						<?= form_input('title', $utama->title, array('class'=>'form-control', 'placeholder'=>'Ketik judul artikel')) ?>
						<?= form_error('title') ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-12" for="first-name">Konten Berita:</label>
					<div class="col-md-12"><?= $this->ckeditor->editor('content', html_entity_decode($utama->content)) ?></div></div>
				</div>
				<div class="form-group">
					<div class="col-md-12"><?= form_error('content') ?></div>
				</div>
		</div>
	</div>
		
	<div class="col-md-3">
		<div class="x_panel">
			<div class="x_title">
				<h2>Opsi Berita</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="form-group"><div class="row">
					<label class="control-label col-md-12" for="first-name">Kategori Berita:</label>
					<div class="col-md-12">
						<?php
						$array_kategori[''] = '--Pilih Kategori--';
						foreach ($kategori as $print) {
							$array_kategori[$print->id] = $print->value;
						}
						?>
						<?= form_dropdown('category', $array_kategori, $utama->category, array('class'=>'form-control')) ?>
						<?= form_error('category') ?>
					</div></div>
				</div>
				<div class="form-group"><div class="row">
					<label class="control-label col-md-12" for="first-name">Pilihan Publikasi Artikel:</label>
					<div class="col-md-12">
						<?php
						$array_opsi = array(1=>'Langsung Tampilkan', 2=>'Simpan sebagai draft');
						?>
						<?= form_dropdown('active', $array_opsi, $utama->active, array('class'=>'form-control')) ?>
						<?= form_error('active') ?>
					</div></div>
				</div>
				<div class="form-group"><div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-primary btn-block"><?= fontawesome('paper-plane') ?> Simpan Artkel</button></div></div>
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
				<h2>Kategori</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="form-group" style="margin-bottom: 80px">
					<label class="control-label col-md-12" for="first-name">Nama Kategori:</label>
					<div class="col-md-12">
						<?= form_input('value', $utama->value, array('class'=>'form-control', 'placeholder'=>'Ketik kategori ')) ?>
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
					<div class="col-md-12"><button type="submit" class="btn btn-primary btn-block"><?= fontawesome('paper-plane') ?> Simpan Artkel</button></div></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>
<?= form_close(); ?>

<?php endforeach ?>