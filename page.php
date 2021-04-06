<?php
if (!defined('ABSPATH')) {
	return;
}

get_header();

global $post;
?>
<div class="cct-page cct-tmp">
	<div class="cct-inner">
		<div class="cct-content">
			<div class="container">
				<?php
				while (have_posts()) {
					the_post();
					the_content();

					wp_link_pages(
						array(
							'before' 		=> '<nav class="cct-page-break cct-pagination">',
							'after'  		=> '</nav>',
							'link_before'	=> '<span class="current">',
							'link_after'	=> '</span>',
						)
					);

					do_action('cct_page_end');

					if (comments_open() || '0' != get_comments_number()) {
						comments_template('', true);
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php

get_footer();
