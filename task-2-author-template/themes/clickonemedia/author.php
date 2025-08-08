<?php get_header(); ?>

<?php
$author_id    = get_the_author_meta('ID');
$author_image = get_field('author_image', 'user_' . $author_id); // ACF field — update name if needed
$author_title = get_field('author_title', 'user_' . $author_id);
$author_first = get_the_author_meta('first_name', $author_id);

// Social links
$socials = [
    'facebook'  => get_field('facebook', 'user_' . $author_id),
    'x'         => get_field('x', 'user_' . $author_id),
    'youtube'   => get_field('youtube', 'user_' . $author_id),
    'instagram' => get_field('instagram', 'user_' . $author_id),
    'linkedin'  => get_field('linkedin', 'user_' . $author_id)
];
?>

<div class="container">
  <main class="author-main">

    <!-- Left: Author Info & Posts -->
    <div class="author-content">
      <section class="author-profile" aria-labelledby="author-heading">

        <div class="top-content">
          <?php if ($author_image): ?>
            <div class="image-wrapper">
              <img
                src="<?php echo esc_url($author_image); ?>"
                alt="<?php echo esc_attr(get_the_author()); ?> - Author profile picture"
                width="297" height="297"
                class="author-image"
                loading="eager"
                decoding="async"
                fetchpriority="high"
              >
            </div>
          <?php endif; ?>

          <div class="author-info">
            <div class="author-text">
              <h1 id="author-heading"><?php the_author(); ?></h1>

              <?php if ($author_title): ?>
                <p class="author-title"><?php echo esc_html($author_title); ?></p>
              <?php endif; ?>
            </div>

            <div class="social-icons" aria-label="Author social media">
              <?php foreach ($socials as $network => $url):
                if ($url): ?>
                  <a href="<?php echo esc_url($url); ?>"
                     target="_blank"
                     rel="noopener noreferrer"
                     class="<?php echo esc_attr($network); ?>"
                     aria-label="<?php echo esc_attr(ucfirst($network)); ?>">
                    <?php $icons = [
                        'facebook'  => '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7231 9L12.1675 6.10437H9.38908V4.22531C9.38908 3.43313 9.77721 2.66094 11.0216 2.66094H12.2847V0.195625C12.2847 0.195625 11.1385 0 10.0425 0C7.75439 0 6.25877 1.38688 6.25877 3.8975V6.10437H3.71533V9H6.25877V16H9.38908V9H11.7231Z" fill="white"/>
                        </svg>',
                        'x'         => '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_33_9626)"><path d="M5.57495 3.021L8.07593 6.32764L8.41772 6.77881L8.79077 6.35303L11.7058 3.021H12.3328L8.95483 6.88232L8.70776 7.16455L8.93433 7.46338L13.1355 13.019H10.5623L7.78101 9.38232L7.43921 8.93506L7.06812 9.35889L3.86499 13.019H3.23706L6.89624 8.83643L7.14526 8.55225L6.91577 8.25244L2.91479 3.021H5.57495ZM3.77905 3.89111L10.4802 12.6509L10.6189 12.8325H12.7996L12.241 12.0933L5.61499 3.33252L5.47632 3.1499H3.21265L3.77905 3.89111Z" fill="white" stroke="white" stroke-width="0.921856"/></g><defs><clipPath id="clip0_33_9626"><rect width="14" height="12.6" fill="white" transform="translate(1 1.30005)"/></clipPath></defs></svg>',
                        'youtube'   => '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.2682 4.33572C15.0937 3.67878 14.5797 3.16139 13.927 2.9858C12.7439 2.66675 7.99999 2.66675 7.99999 2.66675C7.99999 2.66675 3.2561 2.66675 2.07302 2.9858C1.42032 3.16141 0.906267 3.67878 0.731795 4.33572C0.414795 5.52647 0.414795 8.01086 0.414795 8.01086C0.414795 8.01086 0.414795 10.4952 0.731795 11.686C0.906267 12.3429 1.42032 12.8388 2.07302 13.0144C3.2561 13.3334 7.99999 13.3334 7.99999 13.3334C7.99999 13.3334 12.7439 13.3334 13.927 13.0144C14.5797 12.8388 15.0937 12.3429 15.2682 11.686C15.5852 10.4952 15.5852 8.01086 15.5852 8.01086C15.5852 8.01086 15.5852 5.52647 15.2682 4.33572ZM6.44846 10.2665V5.75522L10.4134 8.01091L6.44846 10.2665Z" fill="white"/></svg>',
                        'instagram' => '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_33_9631)"><path d="M14.3586 5.37783C14.3515 4.84039 14.2507 4.30829 14.0608 3.80533C13.8961 3.38109 13.6447 2.9958 13.3224 2.67409C13.0002 2.35237 12.6142 2.1013 12.1893 1.93692C11.692 1.75054 11.1666 1.64977 10.6355 1.63888C9.9517 1.60837 9.7349 1.59985 7.99914 1.59985C6.26338 1.59985 6.0409 1.59985 5.36209 1.63888C4.83124 1.64985 4.3061 1.75062 3.80901 1.93692C3.38399 2.10119 2.998 2.35222 2.67574 2.67395C2.35347 2.99568 2.10202 3.38102 1.93748 3.80533C1.75042 4.30144 1.6497 4.82583 1.63966 5.35584C1.60909 6.03919 1.59985 6.25563 1.59985 7.9885C1.59985 9.72138 1.59985 9.94277 1.63966 10.6212C1.65032 11.152 1.75054 11.6757 1.93748 12.1731C2.1023 12.5973 2.35393 12.9825 2.67631 13.3041C2.99868 13.6256 3.38471 13.8766 3.80972 14.0408C4.30545 14.2347 4.83068 14.3426 5.3628 14.3601C6.0473 14.3906 6.26409 14.3999 7.99985 14.3999C9.73562 14.3999 9.95809 14.3999 10.6369 14.3601C11.168 14.3497 11.6934 14.2491 12.1907 14.0628C12.6155 13.8982 13.0014 13.6471 13.3236 13.3254C13.6458 13.0037 13.8974 12.6185 14.0622 12.1944C14.2492 11.6976 14.3494 11.174 14.36 10.6425C14.3906 9.95981 14.3999 9.74337 14.3999 8.00979C14.3984 6.27691 14.3984 6.05693 14.3586 5.37783ZM7.99488 11.2655C6.17951 11.2655 4.70887 9.7973 4.70887 7.98495C4.70887 6.1726 6.17951 4.70441 7.99488 4.70441C8.86638 4.70441 9.70219 5.05004 10.3184 5.66526C10.9347 6.28048 11.2809 7.1149 11.2809 7.98495C11.2809 8.85501 10.9347 9.68942 10.3184 10.3046C9.70219 10.9199 8.86638 11.2655 7.99488 11.2655ZM11.4117 5.34803C11.311 5.34812 11.2113 5.3284 11.1183 5.28999C11.0253 5.25158 10.9408 5.19524 10.8697 5.12419C10.7985 5.05313 10.742 4.96877 10.7036 4.87592C10.6651 4.78306 10.6453 4.68355 10.6454 4.58307C10.6454 4.48266 10.6652 4.38323 10.7037 4.29046C10.7422 4.1977 10.7986 4.11341 10.8698 4.04241C10.9409 3.97141 11.0253 3.91509 11.1182 3.87666C11.2111 3.83824 11.3107 3.81846 11.4113 3.81846C11.5119 3.81846 11.6115 3.83824 11.7044 3.87666C11.7973 3.91509 11.8818 3.97141 11.9529 4.04241C12.024 4.11341 12.0804 4.1977 12.1189 4.29046C12.1574 4.38323 12.1772 4.48266 12.1772 4.58307C12.1772 5.006 11.8346 5.34803 11.4117 5.34803Z" fill="white"/><path d="M7.98424 10.1159C9.16114 10.1159 10.1152 9.16187 10.1152 7.98497C10.1152 6.80807 9.16114 5.854 7.98424 5.854C6.80734 5.854 5.85327 6.80807 5.85327 7.98497C5.85327 9.16187 6.80734 10.1159 7.98424 10.1159Z" fill="white"/> </g><defs><clipPath id="clip0_33_9631"><rect width="16" height="16" fill="white"/></clipPath></defs>
                        </svg>',
                        'linkedin'  => '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.13375 13.9999H1.23125V4.65306H4.13375V13.9999ZM2.68094 3.37806C1.75281 3.37806 1 2.60931 1 1.68118C1 1.23537 1.1771 0.807816 1.49234 0.492579C1.80757 0.177342 2.23513 0.000244141 2.68094 0.000244141C3.12675 0.000244141 3.5543 0.177342 3.86954 0.492579C4.18478 0.807816 4.36188 1.23537 4.36188 1.68118C4.36188 2.60931 3.60875 3.37806 2.68094 3.37806ZM14.9969 13.9999H12.1006V9.44993C12.1006 8.36556 12.0787 6.97493 10.5916 6.97493C9.0825 6.97493 8.85125 8.15306 8.85125 9.37181V13.9999H5.95188V4.65306H8.73562V5.92806H8.77625C9.16375 5.19368 10.1103 4.41868 11.5225 4.41868C14.46 4.41868 15 6.35306 15 8.86556V13.9999H14.9969Z" fill="white"/></svg>'
                    ];

                    echo $icons[$network] ?? ''; ?>
                  </a>
                <?php endif;
              endforeach; ?>
            </div>
          </div>
        </div>

        <div class="bottom-content">
          <h2>About <?php the_author(); ?></h2>

          <div class="collapsible-wrapper" id="collapsible-wrapper">
            <p class="collapsible" id="expandable-paragraph">
              <?php echo wp_kses_post(get_the_author_meta('description')); ?>
              <span class="expand-button" id="toggle-expand" role="button" tabindex="0" aria-expanded="false">Expand</span>
            </p>
          </div>

        </div>

        <?php if (have_posts()): ?>
          <div class="author-posts">
            <h2>Latest Posts from <?php echo esc_html($author_first); ?></h2>

            <ul class="author-post-list" style="list-style: none; padding: 0; margin: 0;">
              <?php while (have_posts()): the_post(); ?>
                <li class="author-post-item">
                  <a class="post-name mobile" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                  <div class="post-wrapper">
                    <div class="post-image">
                      <?php if (has_post_thumbnail()): ?>
                        <a href="<?php the_permalink(); ?>" class="image-link">
                          <?php the_post_thumbnail('custom-thumb-177', [
                            'loading'  => 'lazy',
                            'decoding' => 'async',
                            'sizes'    => '(max-width: 600px) 100vw, 177px',
                            'alt'      => esc_attr(get_the_title())
                          ]); ?>
                        </a>
                      <?php endif; ?>
                    </div>

                    <div class="post-info">
                      <a class="post-name desktop" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endwhile; ?>
            </ul>

            <div class="pagination-wrapper">
              <a href="#" class="active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">
                <img src="/wp-content/uploads/2025/08/pagination-next.png" alt="Pagination icon - next page | PokerStrategy.com" width="16" height="15">
              </a>
              <a href="#" class="last">
                <span>Last (148)</span>
                <img src="/wp-content/uploads/2025/08/pagination-last.png" alt="Pagination icon - last page | PokerStrategy.com" width="14" height="14">
              </a>
            </div>
          </div>
        <?php else: ?>
          <p>No posts found.</p>
        <?php endif; ?>
      </section>
    </div>

    <!-- Right: Latest Posts Sidebar -->
    <aside class="sidebar" aria-labelledby="latest-news-heading">
      <div class="sidebar-wrapper">
        <h3 id="latest-news-heading">Latest News</h3>
        <ul>
          <?php
          $latest_posts = new WP_Query([
            'posts_per_page'      => 4,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true, // performance optimization
          ]);

          if ($latest_posts->have_posts()):
            while ($latest_posts->have_posts()): $latest_posts->the_post();
          ?>
              <li class="latest-post-item">
                <div class="latest-post-thumb">
                  <a href="<?php the_permalink(); ?>" class="image-link">
                    <?php if (has_post_thumbnail()): ?>
                      <?php the_post_thumbnail('custom-thumb-50', [
                        'loading'  => 'lazy',
                        'decoding' => 'async',
                        'alt'      => esc_attr(get_the_title())
                      ]); ?>
                    <?php endif; ?>
                  </a>
                </div>
                <div class="latest-post-info">
                  <a href="<?php the_permalink(); ?>" class="post-name"><?php the_title(); ?></a>
                </div>
              </li>
          <?php
            endwhile;
            wp_reset_postdata();
          else:
            echo '<li>No recent posts.</li>';
          endif;
          ?>
        </ul>

        <a href="<?php echo esc_url(get_post_type_archive_link('post') ?: '#'); ?>" class="see-all">See all news</a>
      </div>
    </aside>

  </main>
</div>

<?php get_footer(); ?>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
  const toggleBtn = document.getElementById('toggle-expand');
  const paragraph = document.getElementById('expandable-paragraph');

  if (toggleBtn && paragraph) {
    toggleBtn.addEventListener('click', function () {
      paragraph.classList.toggle('expanded');
      const expanded = paragraph.classList.contains('expanded');
      toggleBtn.textContent = expanded ? 'Collapse' : 'Expand';
      toggleBtn.setAttribute('aria-expanded', expanded);
    });

    // keyboard accessibility for Enter/Space
    toggleBtn.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleBtn.click();
      }
    });
  }
});
</script>
