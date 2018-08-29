          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> Total Artikel</span>
              <div class="count"><?= $this->app_model->count_rows('posting', 'where', array('active'=>1)) ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i>Jumlah artikel</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> Total Berkas Unggah</span>
              <div class="count"><?= $this->app_model->count_rows('upload', 'where', array('active'=>1)) ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i>Jumlah berkas unggah</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> Total User</span>
              <div class="count green"><?= $this->app_model->count_rows('user', 'where', array('active'=>1)) ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i>Jumlah admin</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> Total Partisipan Kuesioner</span>
              <div class="count green"><?= $this->app_model->count_rows('polling_hasil') ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i>Jumlah partisipan</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> Berita</span>
              <div class="count"><?= $this->app_model->count_rows('posting', 'where', array('active'=>1, 'type'=>'article')) ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i>Jumlah artikel berita</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> Agenda</span>
              <div class="count"><?= $this->app_model->count_rows('posting', 'where', array('type'=>'agenda', 'active'=>1)) ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i>Jumlah agenda</span>
            </div>
          </div>
          <!-- /top tiles -->