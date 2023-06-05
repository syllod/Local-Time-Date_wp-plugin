<?php
/*
 * Plugin Name: Local Time-Date
 * Plugin URL: https://github.com/syllod/Local-Time-Date_wp-plugin
 * Description: A plugin to display the visitor's local time and date on posts and pages using shortcodes.
 * Version: 1.0.0
 * Author: Sylvain L - Syllod
 * Author URI: https://github.com/syllod
*/

function display_local_time() {
    $timezone = date_default_timezone_get();
    $local_time = date('H:i:s');
    
    ob_start();
    ?>
    <span id="local-time"><?php echo $local_time; ?></span>
    <script>
    function updateLocalTime() {
        var date = new Date();
        var hours = date.getHours().toString().padStart(2, '0');
        var minutes = date.getMinutes().toString().padStart(2, '0');
        var seconds = date.getSeconds().toString().padStart(2, '0');
        var timeString = hours + ":" + minutes + ":" + seconds;
        document.getElementById("local-time").textContent = timeString;
    }
    setInterval(updateLocalTime, 1000);
    </script>
    <?php
    return ob_get_clean();
}

function display_local_date() {
    $local_date = date('d/m/Y');
    
    ob_start();
    ?>
    <span id="local-date"><?php echo $local_date; ?></span>
    <?php
    return ob_get_clean();
}

function shortcode_local_time() {
    return display_local_time();
}
add_shortcode('local_time', 'shortcode_local_time');

function shortcode_local_date() {
    return display_local_date();
}
add_shortcode('local_date', 'shortcode_local_date');

function local_time_plugin_init() {
    // Register shortcodes here
    add_shortcode('local_time', 'shortcode_local_time');
    add_shortcode('local_date', 'shortcode_local_date');
}
add_action('init', 'local_time_plugin_init');

function local_time_plugin_loaded() {
    // Load translations and perform other actions after plugins are loaded
}
add_action('plugins_loaded', 'local_time_plugin_loaded');
