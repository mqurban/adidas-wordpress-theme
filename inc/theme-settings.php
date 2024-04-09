<?php


// adding theme setttings page in backend
function theme_settings_page()
{
    add_menu_page('Figma Theme', 'Figma Theme', 'manage_options', 'theme-settings', 'theme_settings_page_fn', null, 99);
}
add_action('admin_menu', 'theme_settings_page');

function theme_settings_page_fn()
{
?>
    <div class="figma-settings-page">
        <h3>Figma Theme Settings 1.0</h3>
        <div class="row">
            <div class="col-4">
                <div id="list-example" class="list-group">
                    <a class="list-group-item list-group-item-action" href="#list-item-1">General Settings</a>
                    <a class="list-group-item list-group-item-action" href="#list-item-2">Slider Settings</a>
                    <a class="list-group-item list-group-item-action" href="#list-item-3">Tabs Settings</a>
                    <a class="list-group-item list-group-item-action" href="#list-item-4">Item 4</a>
                </div>
            </div>
            <div class="col-8">
                <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
                    <h4 id="list-item-1" class="btn btn-primary d-block">General Settings</h4>

                    <!-- Slider file is located at: wp-content/themes/figma-wordpress-theme/inc/general-settings.php -->
                    <?php require_once(get_theme_file_path('/inc/general-settings.php')); ?>

                    <hr>
                    <h4 id="list-item-2" class="btn btn-primary d-block">Slider Settings</h4>
                    <!-- Slider file is located at: wp-content/themes/figma-wordpress-theme/inc/slider-settings.php -->
                    <?php require_once(get_theme_file_path('/inc/slider-settings.php')); ?>


                    <h4 id="list-item-3" class="btn btn-primary d-block">Tabs Settings</h4>

                    <!-- Slider file is located at: wp-content/themes/figma-wordpress-theme/inc/slider-settings.php -->
                    <?php require_once(get_theme_file_path('/inc/tabs-settings.php')); ?>


                    <h4 id="list-item-4">Item 4</h4>
                    <p>...</p>
                </div>
            </div>
        </div>
    </div>

<?php
}
