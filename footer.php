<footer class="footer">
    <div class="container">
        <div class="footer-wrapper">
            <div class="footer-logo logo-black">
                <?php 
                if (has_custom_logo()) :
                    the_custom_logo();
                else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo-black.svg" alt="logo black">
                <?php endif; ?>
            </div>
            <div class="footer-menu">
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_menu',
                    'container' => 'nav',
                    'menu_class' => 'footer-menu__list',
                ]);
                ?>
            </div>
        </div>
    </div>
    
</footer>
<?php wp_footer(); ?>

</body>
</html>
