<?php
/**
 * Plugin Name: Foleo Analytics Loader
 * Description: Inject GA4 and Hotjar sitewide via MU-plugin for stability.
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

/**
 * Hotjar in <head>
 */
add_action('wp_head', function () {
    // Avoid firing in admin screens
    if (is_admin()) { return; }

    $hotjar_site_id = 6615224;
    if (!$hotjar_site_id) { return; }
    ?>
    <!-- Hotjar Tracking Code -->
    <script>
      (function(h,o,t,j,a,r){
          h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
          h._hjSettings={hjid:<?php echo (int) $hotjar_site_id; ?>,hjsv:6};
          a=o.getElementsByTagName('head')[0];
          r=o.createElement('script');r.async=1;
          r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
          a.appendChild(r);
      })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <?php
}, 21);