<?php get_header() ?>
	<div id="container">
		<div id="content">
			<div id="middle">
				<div id="middle-left">
					<?php the_post() ?>
					<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?><?php sticky_class(); ?>">
						<h2 class="entry-title"><?php the_title() ?></h2>
						<div class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php unset($previousday); printf( __( '%1$s &#8211; %2$s', 'sandbox' ), the_date( '', '', '', false ), get_the_time() ) ?></abbr></div><!-- .entry-date -->
						<div class="entry-content">
							<?php the_content() ?>
							<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'sandbox' ) . '&after=</div>') ?>
						</div><!-- .entry-content -->
						<div class="entry-meta">
							<?php printf( __( 'This entry was written by %1$s, posted on <abbr class="published" title="%2$sT%3$s">%4$s at %5$s</abbr>, filed under %6$s%7$s. Bookmark the <a href="%8$s" title="Permalink to %9$s" rel="bookmark">permalink</a>. Follow any comments here with the <a href="%10$s" title="Comments RSS to %9$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.', 'sandbox' ),
								'<span class="author vcard"><a class="url fn n" href="' . get_author_link( false, $authordata->ID, $authordata->user_nicename ) . '" title="' . sprintf( __( 'View all posts by %s', 'sandbox' ), $authordata->display_name ) . '">' . get_the_author() . '</a></span>',
								get_the_time('Y-m-d'),
								get_the_time('H:i:sO'),
								the_date( '', '', '', false ),
								get_the_time(),
								get_the_category_list(', '),
								get_the_tag_list( __( ' and tagged ', 'sandbox' ), ', ', '' ),
								get_permalink(),
								the_title_attribute('echo=0'),
								comments_rss() ) ?>

								<?php if ( ('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Comments and 	trackbacks open ?>
									<?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'sandbox' ), get_trackback_url() ) ?>
								<?php elseif ( !('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Only trackbacks open ?>
									<?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'sandbox' ), get_trackback_url() ) ?>
								<?php elseif ( ('open' == $post->comment_status) && !('open' == $post->ping_status) ) : // Only comments open ?>
									<?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'sandbox' ) ?>
								<?php elseif ( !('open' == $post->comment_status) && !('open' == $post->ping_status) ) : // Comments and trackbacks closed ?>
									<?php _e( 'Both comments and trackbacks are currently closed.', 'sandbox' ) ?>
								<?php endif; ?>
								<?php edit_post_link( __( 'Edit', 'sandbox' ), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>" ) ?>
							</div><!-- .entry-meta -->
						<?php comments_template('', true); ?>
						</div><!-- .post -->
				</div><!-- #middle-left -->
				<div id="middle-right"><?php get_sidebar() ?></div><!-- #middle-right -->
			</div><!-- #middle -->
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_footer() ?>