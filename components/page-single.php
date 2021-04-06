<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 3/29/2021
 * Time: 9:06 AM
 */

global $post;
?>

<article id="post-<?php esc_attr(the_ID()); ?>" <?php post_class(); ?>>
	<?php echo cct_single_thumbnail(); ?>

	<div class="post-meta">
		<?php echo cct_generate_html_terms_list($post->ID, 'category'); ?>
		<?php echo cct_single_author(); ?>
		<?php echo cct_single_date(); ?>
	</div>
	<?php cct_single_content(); ?>
	<div class="post-footer-info">
		<?php echo cct_generate_html_terms_list($post->ID, 'post_tag'); ?>
		<?php echo cct_single_comments(); ?>
	</div>
	<?php echo cct_single_section_author_info(); ?>
	<?php
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
	?>
</article>
