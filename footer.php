<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package figma-wordpress-theme
 */

?>
<div class="footermain">

    <div class="footer1">
        <?php dynamic_sidebar('footer-menu-1') ?>
    </div>

    <div class="footer1">
        <?php dynamic_sidebar('footer-menu-2') ?>

    </div>
    <div class="footer1" id="footerlogo">
        <?php dynamic_sidebar('copyright-section') ?>


    </div>
</div>
<?php wp_footer(); ?>
</body>

</html>