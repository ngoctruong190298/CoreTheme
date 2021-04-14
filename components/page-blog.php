<?php
/*
 * template name: blog page
 * */
get_header();?>

<div class="container">
    <div class="page-blog row">
        <!-- Get post News Query -->
        <?php $getposts = new WP_query();
        $getposts->query(array(
            'post_type'=>'post',
            'post_status'=>'publish',
            'cat' => '24',
            'posts_per_page' => 19,
            'orderby' => 'date',
            'order' => 'ASC',
        )); ?>

        <?php global $wp_query; $wp_query->in_the_loop = true;?>
        <?php $i=1 ;while ($getposts->have_posts()) : $getposts->the_post(); ?>
            <?php if($i== cct_get_option('ads')) {?>

                <div class="col-md-8">
                    <div class="blogs3">
                        <div><a href="<?php the_permalink(); ?>"></a><?php the_post_thumbnail(); ?></div>
                        <div class="blogs3-inner1">
                        <div class="blogs3-1">$129</div>
                        <div class="blogs3-2"></div>
                        </div>
                        <div class="blogs3-inner">
                            <h2><?php the_content();?></h2>
                            <h3><?php the_title(); ?></h3>
                            <a href="<?php the_permalink(); ?>"> Explore Now</a>

                        </div>
                    </div>
                </div>

            <?php }elseif($i== cct_get_option('ads2')) {?>
                <div class="col-md-8">
                    <div class="blogs4">
                        <div><a href="<?php the_permalink(); ?>"></a><?php the_post_thumbnail(); ?></div>

                        <div class="blogs4-inner">
                            <h2><?php the_title();?></h2>
                            <h3><?php the_content(); ?></h3>
                            <div class=" d-flex blogs4-inner1">
                                <div class="blogs4-1">$29 </div>
                                <div class="blogs4-2">
                                    <div class="blogs4-2-inner1">
                                        <?php echo cct_get_option('text1-ads2');?>
                                    </div>
                                    <div class="blogs4-2-inner2">
                                        <?php echo cct_get_option('text2-ads2');?>
                                    </div>
                                    <div class="blogs4-2-inner3">
                                        <?php echo cct_get_option('text3-ads2');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }elseif($i==5 || $i==12) {?>
                <div  class="col-md-4">
                    <div class="blogs5">
                        <div><a href="<?php the_permalink(); ?>"></a><?php the_post_thumbnail(); ?></div>
                        <div class="blogs5-date"><?php echo get_the_date();?>
                        </div>
                        <div class="blogs5-span">By <a><?php echo get_the_author(); ?></a>    Collections</div>
                        <div class="blogs5-h3"><?php the_title(); ?></div>
                        <div class="blogs5-a"><a href="<?php the_permalink(); ?>"> Continue Reading</a></div>
                    </div>
                </div>
            <?php }else{?>
                <div  class="col-md-4">
                    <div class="blogs2">
                        <div><a href="<?php the_permalink(); ?>"></a><?php the_post_thumbnail(); ?></div>
                        <div class="blogs2-date"><?php echo get_the_date();?></div>
                    </div>
                    <div class="blogs2-inner">
                        <div class="blogs2-inner-span"><span>By <a><?php echo get_the_author(); ?></a>    Collections</span></div>
                        <h3><?php the_title(); ?></h3>
                        <div class="blogs2-inner-a"><a href="<?php the_permalink(); ?>"> Continue Reading</a></div>
                    </div>

                </div>
            <?php }?>
        <?php $i++?>
        <?php endwhile; wp_reset_postdata(); ?>
        <!-- Get post News Query -->
    </div>
</div>

<?php
get_footer();?>
