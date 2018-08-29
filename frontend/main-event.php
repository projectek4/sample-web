<div class="news-content">
<?php foreach ($list as $print): ?>
	<div class="news-list">
		<?= html_head($print->title, 3) ?>
		<span>By <b><?= print_data('get_where', array('user', array('id'=>$print->author)), 'nama') ?></b> , <i><?= full_date($print->date_posting).' </i> - '.print_data('get_where', array('posting_category', array('id'=>$print->author)), 'name').', dibaca '.$print->view.' kali' ?></span>
		<div class="news-body">
			<img src="<?= $print->media ?>" class="news-media">
			<div><?= word_limit(strip_tags($print->content), 60, anchor($print->url, ' <i>Baca Selengkapnya</i>')) ?></div>
		</div>
	</div>
<?php endforeach ?>
</div>
