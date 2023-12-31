<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package oslabs
 */
$parallex_page = function_exists( 'get_field' ) ? get_field( 'parallex_page' ) : '';
?>

<?php do_action( 'oslabs_footer_style' ); ?>

    <?php if(!empty($parallex_page)) : ?>
        </div>
            </div>
    <?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
