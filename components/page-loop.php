<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 9/15/2019
 * Time: 10:28 PM
 */

global $wp_query;

$blog_layout 		= cct_get_option('blog_layout', 'list');
$blog_sidebar		= cct_get_option('blog_sidebar', 'right');
$widget				= cct_get_option('blog_sidebar_type', 'primary-bar');

$blog_layout		= isset($_GET['layout']) ? $_GET['layout'] : $blog_layout;
$blog_sidebar		= isset($_GET['sidebar']) ? $_GET['sidebar'] : $blog_sidebar;

$class				= ($blog_sidebar != 'full' && is_active_sidebar($widget)) ? 'cct-has-bar cct-bar-' . $blog_sidebar : 'cct-full';
$name				= ($blog_layout == 'list') ? 'list' : 'grid';

if ($blog_layout == 'masonry') {
	wp_enqueue_script('imagesloaded');
	wp_enqueue_script('isotope');
}

?>

<div class="cct-archive cct-tmp">
	<div class="cct-inner">
		<div class="container">
			<div class="cct-archive-<?php echo esc_attr($blog_sidebar); ?> <?php echo esc_attr($class); ?>">
				<div class="cct-content cct-archive-content">
					<div class="cct-<?php echo esc_attr($name); ?>">
						<div class="blog-<?php echo esc_attr($name); ?>">
							<?php get_template_part('components/archives/' . $name); ?>
						</div>
						<?php
							if (cct_get_option('blog_pagination') != 'hide') {
								cct_pagination();
							}

							wp_reset_postdata();
						?>
					</div>
				</div>

				<?php if ($blog_sidebar != 'full') : ?>
					<?php get_sidebar(); ?>
				<?php endif; ?>
			</div>
		</div>

	</div>
</div>

