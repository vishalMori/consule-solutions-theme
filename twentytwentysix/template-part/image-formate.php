<div class="col-lg-6">
  <div class="row list-two">
    <div class="col-lg-12">
      <div class="card">
        <a href="#">
          <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="blog-home" width="527" height="263" />
          <div class="overlay-text">
            <div class="date"><?php echo esc_url(the_date()); ?></div>
            <h3 class="h4 blog-title">
              <?php echo get_the_title(); ?>
            </h3>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>