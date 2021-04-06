<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 9/23/2019
 * Time: 3:13 PM
 */

global $post;

$size = 'full';

$blog_layout	= cct_get_option('blog_layout', 'list');
$is_masonry		= ($blog_layout == 'masonry') ? 'cct-masonry' : '';

$img_class	= has_post_thumbnail() ? 'has-thumb' : 'no-thumb';
$column		= 12/cct_get_option('blog_columns', 3);
$column_ls	= 'masonry-item col-md-' . $column;

?>
<div class="grid-style-1-content row <?php echo esc_attr($is_masonry); ?>">
	<?php
	if (have_posts()) {
		while (have_posts()) :
			the_post();

			?>
			<article id="post-<?php esc_attr(the_ID()); ?>" <?php post_class($column_ls); ?>>
				<?php cct_blog_thumbnail($size); ?>
				<div class="entry-post-content">
					<?php cct_blog_title(); ?>
					<div class="entry-meta">
						<?php cct_blog_date(); ?>
					</div>
				</div>
			</article>
			<?php
		endwhile;
	}
	?>
</div>
