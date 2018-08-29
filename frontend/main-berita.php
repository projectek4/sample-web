<div class="container">
	<div class="row">
		<div class="col-md-8 berita-kiri">
		<?php foreach ($list as $print): ?>
			<div class="media">

					<span><?= fontawesome('clock-o').' Diunggah pada: '.tanggal($print->date_posting).'  '. fontawesome('user').' oleh: '.print_data('get_where', array('user', array('id'=>$print->author)), 'nama') ?></span>
				<?= anchor($print->url, heading($print->title, 2, array('class'=>'media-heading'))); ?>
				<div class="media-left">
						<?= html_media($print->media, 'media-object') ?>

				</div>
				<div class="media-body">
					<p><?= word_limiter(strip_tags($print->content), 50) ?></p>
				</div>
			</div>
		<?php endforeach ?>
		<?= $pagination ?>
		</div>
		<div class="col-md-4 berita-kanan">
			<h4>Paling Banyak Dibaca</h4>
			<ul>
			<?php foreach ($viewed as $print): ?>
				<li><?= anchor($print->url, $print->title) ?></li>
			<?php endforeach ?>
			</ul>
			<h4 style="margin-top: 60px;">Arsip Berita</h4>
			<ul>
			<?php foreach ($arsip as $print): ?>
				<li><?= anchor('arsip/'.$print->date, archive_month($print->date).'('.$print->jumlah.')') ?></li>
			<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>




<!--<ul class="media-list">
					<li class="media">
							<div class="media-left">
			<?= html_media($print->media, 'media-object') ?>
		</div>
		<div class="media-body">
			<span><?= fontawesome('calendar-o').' '.short_tanggal($print->date_posting).'  '. fontawesome('user').' '.print_data('get_where', array('user', array('id'=>$print->author)), 'nama') ?></span>
			<?= anchor($print->url, heading($print->title, 5, array('class'=>'media-heading'))) ?>
		</div>
	</li>
</ul>-->