<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
      <p class="entry-posted">
        <time class="published" title="<?php the_time('Y-m-d\TH:i:sP'); ?>" datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>">
          <a class="posted-month" href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" title="See all posts from <?php echo get_the_time('F, Y'); ?>"><?php the_time('M'); ?></a>
          <span class="posted-date"><?php the_time('j'); ?></span>
          <a class="posted-year" href="<?php echo get_year_link(get_the_time('Y'), get_the_time('y')); ?>" title="See all posts from <?php echo get_the_time('Y'); ?>"><?php the_time('Y'); ?></a>
        </time>
      </p>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
    <?php edit_post_link( __( 'Edit Post', 'onemozilla' ), '<p class="edit">', '</p>' ); ?>
		<?php if (has_post_thumbnail()) { the_post_thumbnail('thumbnail', array('alt' => "", 'title' => "")); } ?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'onemozilla' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
    <ul class="share">
      <li><a class="facebook" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink());?>&amp;t=<?php echo urlencode(get_the_title_rss()); ?>" title="<?php _e('Share this on Facebook', 'onemozilla'); ?>"><span><?php _e('Share this on Facebook', 'onemozilla'); ?></span></a></li>
      <li><a class="twitter" href="https://twitter.com/intent/tweet?url=<?php echo wp_get_shortlink(); ?>&amp;text=<?php echo urlencode(get_the_title_rss().' - '); ?>&amp;via=firefox" title="<?php _e('Share this on Twitter', 'onemozilla'); ?>"><span><?php _e('Share this on Twitter', 'onemozilla'); ?></span></a></li>
    </ul>

  <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
		<?php if (has_tag()) : ?>
		  <p class="meta"><b><?php _e('Tags','onemozilla'); ?>:</b> <?php $tags_list = the_tags('',', ',''); ?></p>
		<?php endif; ?>
      <p class="meta"><b><?php _e('Categories','onemozilla'); ?>:</b> <?php the_category(', ') ?></p>
  <?php endif; ?>

	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
