<?php
if (!defined('ABSPATH')) {
	return;
}
?>

<div class="section-comments">
	<?php if (have_comments()) : ?>
		<div class="cct-list-comments">
			<h3>
				<?php echo get_comments_number() . esc_html__(' Comments', 'cct'); ?>
			</h3>

			<ol class="comment-list">
				<?php
				wp_list_comments(array(
					'style'			=> 'ol',
					'avatar_size'	=> 95,
				));
				?>
			</ol>

			<?php if (get_comment_pages_count() > 1) : ?>
			<nav class="comment-navigation" role="navigation">
				<div class="nav-previous">
					<?php previous_comments_link('<i class="fa fa-angle-left"></i> ' . esc_html__('Older Comments', 'cct')); ?>
				</div>
				<div class="nav-next">
					<?php next_comments_link(esc_html__('Newer Comments', 'cct') . ' <i class="fa fa-angle-right"></i>'); ?>
				</div>
				<div class="clearfix"></div>
			</nav>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="cct-comment-form">
		<?php echo cct_comment_form(); ?>
	</div>
</div>

