<?php
?>
<footer class="cct-footer">
    <div class="container">
        <div class="row main-footer">
            <div class="main-footer-left col-4">
                <div class="logo-footer">
                    <?php if ( is_active_sidebar( 'footer-logo' ) ) { ?>
                        <?php dynamic_sidebar( 'footer-logo' ); ?>
                    <?php } ?>
                </div>
                <div class="description-footer">
                    <?php if ( is_active_sidebar( 'footer-logo-text' ) ) { ?>
                        <?php dynamic_sidebar( 'footer-logo-text' ); ?>
                    <?php } ?>
                </div>
            </div>
            <div class="main-footer-center col-4">
                <div class="menu-footer">
                    <?php if ( is_active_sidebar( 'footer-link' ) ) { ?>
                        <?php dynamic_sidebar( 'footer-link' ); ?>
                    <?php } ?>
                </div>
            </div>

            <div class="main-footer-right col-4">
                <div class="post-footer">
                    <?php if ( is_active_sidebar( 'footer-post' ) ) { ?>
                        <?php dynamic_sidebar( 'footer-post' ); ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo cct_footer_japan()?>
</footer>

