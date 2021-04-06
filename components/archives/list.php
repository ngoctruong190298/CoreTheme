<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 9/20/2019
 * Time: 3:50 PM
 */

global $post;

$size = 'full';

if (have_posts()) {
	while (have_posts()) :
		the_post();

		?>
		<article id="post-<?php esc_attr(the_ID()); ?>" <?php post_class(); ?>>
			<?php if (has_post_thumbnail()) : ?>
				<div class="entry-image">
					<?php cct_blog_thumbnail($size); ?>
					<?php echo cct_generate_html_terms_list($post->ID, 'category'); ?>
				</div>
			<?php endif; ?>
			<div class="entry-post-content">
				<?php cct_blog_title(); ?>
				<div class="entry-meta">
					<?php cct_blog_date(); ?>
				</div>
				<?php cct_blog_excerpt(50); ?>
				<a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>" class="entry-readmore">
					<?php echo esc_html__('Read more', 'cct'); ?>
				</a>
			</div>
		</article>
		<?php
	endwhile;
}



