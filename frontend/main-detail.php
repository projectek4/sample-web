<div class="container">
	<div class="row">
		<div class="col-md-8 berita-kiri">
			<?php foreach ($detail as $print): ?>
			<div class="row">
				<div class="col-sm-12 article_box">
					<?php if ($print->type == 'article'): ?>
					<?= html_head($print->title, 1) ?>
					<div class="post_commentbox"> <a href="#">Diunggah oleh: <?= print_data('get_where', array('user', array('id'=>$print->author)), 'nama') ?></a> <span><i class="fa fa-clock"></i><?= full_date($print->date_posting) ?></span> <a href="#"><i class="fa fa-tags"></i><?= print_data('get_where', array('posting_category', array('id'=>$print->category)), 'name') ?></a> </div>
					<?php endif ?>
					<div class="single_page_content">
						<?= $print->content ?>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<div class="col-md-4 berita-kanan">
			<h4>Paling Banyak Dibaca</h4>
			<ul>
			<?php foreach ($viewed as $print): ?>
				<li><?= anchor($print->url, $print->title) ?></li>
			<?php endforeach ?>
			</ul>
			<h4>Arsip Berita</h4>
			<ul>
			<?php foreach ($arsip as $print): ?>
				<li><?= anchor('arsip/'.$print->date, $print->date.'('.$print->jumlah.')') ?></li>
			<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>