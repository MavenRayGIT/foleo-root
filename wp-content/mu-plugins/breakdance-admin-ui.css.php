<?php
/**
 * Hide Breakdance Code Block editor banner (inside editor iframe)
 */
add_action('breakdance/editor/head', function () {
  echo '<style>
    .bde-code-block > div:first-child {
      display: none !important;
    }
  </style>';
});