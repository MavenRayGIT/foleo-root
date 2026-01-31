<?php
/**
 * Plugin Name: Foleo Analytics Loader
 * Description: Inject GA4 sitewide via MU-plugin for stability.
 */

/**
 * GA4 in <head>
 */
add_action('wp_head', function () {
    // Avoid firing in admin screens
    if (is_admin()) { return; }

    $ga_measurement_id = 'G-QPVELQELTP';
    if (!$ga_measurement_id) { return; }
    ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_measurement_id); ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?php echo esc_attr($ga_measurement_id); ?>');
    </script>
    <?php
}, 20);
