<?php
$oslabs_content_padding_top = empty(has_post_thumbnail()) ? '' : '';
$cbtoolkit_blog_btn_switch = get_theme_mod('cbtoolkit_blog_btn_switch', true);
$cbtoolkit_blog_meta_switch = get_theme_mod('cbtoolkit_blog_meta_switch', true);
$cbtoolkit_blog_author_switch = get_theme_mod('cbtoolkit_blog_author_switch', true);
$cbtoolkit_blog_date_switch = get_theme_mod('cbtoolkit_blog_date_switch', true);
$cbtoolkit_blog_comments_switch = get_theme_mod('cbtoolkit_blog_comments_switch', true);
$cbtoolkit_blog_btn_text = get_theme_mod('cbtoolkit_blog_btn_text', __('Read More', 'oslabs'));
$oslabs_video_url = function_exists('get_field') ? get_field('fromate_style') : NULL;

$categories = get_the_terms($post->ID, 'category');
$video_id = oslabs_getYoutubeIdFromUrl($oslabs_video_url);
$oslabs_cat  = get_the_category(get_the_ID()) ? (array) get_the_category(get_the_ID())[0]: '';
$first_cat_name = '';
$first_cat_id = '';
$first_cat_url = '';
if(!empty($oslabs_cat)) {
    $first_cat_name = $oslabs_cat['name'];
    $first_cat_id = $oslabs_cat['term_id'];
    $first_cat_url = get_category_link( $first_cat_id );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-blog format-video mb-40'); ?>>
    <div class="oslabs-fz-blog-thumbnail-content-wrapper-main-448 oslabs-fz-blog-thumbnail-447">
        <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : ?>
            <div class="oslabs-fz-thumbnail-image">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title_attribute(); ?>">
                <?php if (!empty($oslabs_video_url)) : ?>
                    <div class="oslabs-fz-format-video-btn-447">
                        <a href="#0" class="video-icon popup-video js-modal-btn" data-video-id="<?php echo esc_attr($video_id) ? esc_attr($video_id) : ''; ?>"><i class="fa-light fa-play"></i><i class="fa-light fa-play"></i></a>
                    </div>
                <?php endif; ?>
                <?php if (!empty($cbtoolkit_blog_date_switch)) : ?>
                    <div class="oslabs-blog-caption-date-447">
                        <span class="day"><?php print esc_html(get_the_date('d', get_the_ID())); ?></span>
                        <span class="month"><?php print esc_html(get_the_date('M', get_the_ID())); ?></span>
                    </div>
                <?php endif; ?>
                <?php if (!empty($cbtoolkit_blog_meta_switch)) : ?>
                    <div class="oslabs-blog-meta-in-box-447 d-none d-sm-flex">
                        <?php if (!empty($cbtoolkit_blog_author_switch)) : ?>
                            <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_avatar(get_the_author_meta('ID')); ?><?php print esc_html(get_the_author()); ?></a>
                        <?php endif; ?>
                        <?php if(!empty($first_cat_name)) : ?>
                            <a href="<?php echo esc_url($first_cat_url) ? esc_url($first_cat_url): ''; ?>"><?php echo esc_html($first_cat_name); ?></a>
                        <?php endif; ?>
                        <?php if (!empty($cbtoolkit_blog_comments_switch)) : ?>
                            <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty(get_the_content())) : ?>
            <div class="oslabs-fz-blog-details-contant-main-wrap-448 oslabs-fz-blog-content-447 <?php echo esc_attr($oslabs_content_padding_top); ?>">
                <?php if (get_the_title()) : ?>
                <h4 class="oslabs-fz-blog-title-447"><?php the_title(); ?></h4>
            <?php endif; ?>

            <?php if (!empty($cbtoolkit_blog_meta_switch)) : ?>
                <div class="oslabs-fz-blog-meta-wrap-447 mb-15 d-sm-none">
                    <?php if (!empty($cbtoolkit_blog_author_switch)) : ?>
                        <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="fal fa-user"></i><?php print esc_html(get_the_author()); ?></a>
                    <?php endif; ?>
                    <?php if(!empty($first_cat_name)) : ?>
                        <a href="<?php echo esc_url($first_cat_url) ? esc_url($first_cat_url): ''; ?>"><i class="fal fa-tag"></i><?php echo esc_html($first_cat_name); ?></a>
                    <?php endif; ?>
                    <?php if (!empty($cbtoolkit_blog_comments_switch)) : ?>
                        <a href="<?php comments_link(); ?>"><i class="fal fa-comments"></i><?php comments_number(); ?></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
                <?php the_content(); ?>
                <?php
                wp_link_pages([
                    'before'      => '<div class="page-links">' . esc_html__('Pages:', 'oslabs'),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ]);
                ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="oslabs-blog-details-tag pt-40">
        <div class="row align-items-center">
            <div class="col-12">
                <?php if(has_category( '', get_the_ID() )) : ?>
                <div class="oslabs-fz-has-category mb-15">
                    <span class="oslabs-fz-tagcloud-label-448 mr-25"><?php echo esc_html__('Category:', 'oslabs'); ?> </span><?php echo get_the_category_list(', ', '', get_the_ID()); ?>
                </div>
                <?php endif; ?>
                <?php if (!empty(oslabs_get_tag())) : ?>
                <?php print oslabs_get_tag(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>