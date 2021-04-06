<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 9/28/2019
 * Time: 9:56 AM
 */
?>

<header class="<?php echo cct_header_generate_class('header-1')['wrap']; ?>">
	<div class="<?php echo cct_header_generate_class('header-1')['inner']; ?>">
		<div class="cct-inner row">
			<div class="h-left d-flex align-items-center col-12 col-md-3">
				<?php echo cct_logo(); ?>
				<?php echo cct_header_menu_mobile_actions('d-inline-flex d-md-none') ?>
			</div>
            <div class="h-right d-none d-md-flex col-md-9">
                <div class="r-top">
	                <?php echo cct_get_language_location(); ?>
                </div>
                <div class="r-bottom">
	                <?php echo cct_header_main_menu(); ?>
                </div>
            </div>
		</div>
	</div>
</header>
