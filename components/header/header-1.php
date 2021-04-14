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
			<div class="h-left d-flex align-items-center col-12 col-lg-3 col-md-6">
                <?php echo cct_header_menu_mobile_actions('d-inline-flex d-lg-none') ?>
				<?php echo cct_logo(); ?>

			</div>
            <div class="h-center d-none d-lg-flex col-lg-6">
                <div class="r-top">
	                <?php echo cct_get_language_location(); ?>
                </div>
                <div class="r-bottom">
	                <?php echo cct_header_main_menu(); ?>
                </div>
            </div>
            <div class="h-right d-none d-md-flex col-lg-3 col-md-6 justify-content-end">
                    <?php echo cct_header_icon_search(); ?>
                    <?php echo cct_header_account(); ?>
                    <?php echo cct_header_icon_cart(); ?>
            </div>
		</div>

	</div>

</header>
<div>
    <?php if(!is_home()){
        echo cct_header_hero();
    } ?>
</div>
