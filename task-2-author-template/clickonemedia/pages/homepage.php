<?php /* Template Name: Homepage */ ?>

<?php get_header(); ?>

  <div class="homepage-content">
    <div class="container">
      <h1>This is Most Viewed Articles widget:</h1>
      <?php if ( is_active_sidebar( 'homepage-widget-area' ) ) : ?>
          <div id="homepage-widgets">
              <?php dynamic_sidebar( 'homepage-widget-area' ); ?>
          </div>
      <?php endif; ?>
    </div>
  </div>

<?php get_footer();
