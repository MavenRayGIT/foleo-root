<?php

if (!defined('ABSPATH')) {
  exit;
}

add_action('init', function () {
  if (post_type_exists('foleo_page')) {
    return;
  }

  register_post_type('foleo_page', array(
    'labels' => array(
      'name' => 'FOLEOs',
      'singular_name' => 'FOLEO',
      'add_new_item' => 'Add FOLEO',
      'edit_item' => 'Edit FOLEO',
      'new_item' => 'New FOLEO',
      'view_item' => 'View FOLEO',
      'search_items' => 'Search FOLEOs',
      'not_found' => 'No FOLEOs found',
      'all_items' => 'FOLEOs',
    ),
    'public' => false,
    'show_ui' => true,
    'show_in_menu' => false,
    'supports' => array('title'),
    'capability_type' => 'post',
    'map_meta_cap' => true,
    'menu_icon' => 'none',
    'show_in_rest' => false,
  ));
});

function foleo_v1_detail_url($post_id) {
  return admin_url('admin.php?page=foleo-v1-detail&foleo_page_id=' . absint($post_id));
}

function foleo_v1_get_bucket_filter() {
  $bucket = isset($_GET['foleo_bucket']) ? sanitize_key(wp_unslash($_GET['foleo_bucket'])) : 'all';
  if (!in_array($bucket, array('all', 'published', 'draft'), true)) {
    $bucket = 'all';
  }
  return $bucket;
}

function foleo_v1_is_foleo_list_screen() {
  if (!foleo_is_client_shell_context()) {
    return false;
  }
  if (!is_admin()) {
    return false;
  }

  global $pagenow;
  if ($pagenow !== 'edit.php') {
    return false;
  }

  $post_type = isset($_GET['post_type']) ? sanitize_key(wp_unslash($_GET['post_type'])) : '';
  return $post_type === 'foleo_page';
}

function foleo_v1_is_public_seo_enabled($post_id) {
  if (get_post_meta($post_id, 'foleo_public_seo_enabled', true) === '1' || get_post_meta($post_id, 'foleo_seo_enabled', true) === '1') {
    return true;
  }
  // Backward compatibility with legacy list toggle meta.
  return get_post_meta($post_id, 'foleo_seo_visibility', true) !== 'off';
}

function foleo_v1_get_preview_url($post_id) {
  $draft_token = trim((string) get_post_meta($post_id, 'foleo_draft_token', true));
  if ($draft_token === '') {
    return '';
  }
  return foleo_v1_draft_url($draft_token);
}

function foleo_v1_get_live_url($post_id) {
  return trim((string) get_post_meta($post_id, 'foleo_live_url', true));
}

function foleo_v1_get_status_label($post) {
  if (!($post instanceof WP_Post)) {
    return '';
  }
  $live_url = foleo_v1_get_live_url($post->ID);
  if ($live_url !== '') {
    return 'Live';
  }
  if ($post->post_status === 'publish') {
    return 'Published';
  }
  return foleo_v1_workspace_status($post->ID);
}

function foleo_v1_review_options() {
  return array(
    'style' => array(
      'architect' => 'Architect',
      'consulting' => 'Consulting',
      'custom' => 'Custom',
    ),
    'page_set' => array(
      'thought_leadership' => 'Thought Leadership',
      'account_brief' => 'Account Brief',
      'proposal_brief' => 'Proposal Brief',
    ),
    'mode' => array(
      'configure' => 'Configure',
      'preview' => 'Preview',
      'live' => 'Live',
    ),
    'config_status' => array(
      'not_started' => 'Not Started',
      'in_progress' => 'In Progress',
      'complete' => 'Complete',
      'locked' => 'Locked',
    ),
  );
}

function foleo_v1_sanitize_choice($value, $allowed, $default) {
  $value = sanitize_key((string) $value);
  if (!array_key_exists($value, $allowed)) {
    return $default;
  }
  return $value;
}

function foleo_v1_generate_draft_token() {
  return wp_generate_password(24, false, false);
}

function foleo_v1_intent_options() {
  return array(
    'thought_leadership' => 'Thought Leadership',
    'account_brief' => 'Account Brief',
    'proposal_brief' => 'Proposal Brief',
  );
}

function foleo_v1_style_label($value) {
  $labels = array(
    'consulting' => 'Consulting',
    'architect' => 'Architect',
    'custom' => 'Custom',
  );
  $value = sanitize_key((string) $value);
  return isset($labels[$value]) ? $labels[$value] : 'Unspecified';
}

function foleo_v1_intent_label($value) {
  $labels = foleo_v1_intent_options();
  $value = sanitize_key((string) $value);
  return isset($labels[$value]) ? $labels[$value] : 'Not set';
}

function foleo_v1_get_intent($post_id) {
  $intent = sanitize_key((string) get_post_meta($post_id, 'foleo_intent', true));
  if ($intent === '') {
    $intent = sanitize_key((string) get_post_meta($post_id, 'foleo_page_set', true));
  }
  return $intent;
}

function foleo_v1_workspace_status($post_id) {
  $token = trim((string) get_post_meta($post_id, 'foleo_draft_token', true));
  $draft_json = trim((string) get_post_meta($post_id, 'foleo_draft_json', true));
  $versions = foleo_v1_get_review_doc_versions($post_id);
  $intent = foleo_v1_get_intent($post_id);
  $public_enabled = foleo_v1_is_public_seo_enabled($post_id);

  if ($public_enabled && $token !== '' && $intent !== '' && !empty($versions)) {
    return 'Ready to Publish';
  }
  if ($draft_json === '' || empty($versions)) {
    return 'Needs Review Doc';
  }
  if ($token !== '') {
    return 'Draft Ready';
  }

  return 'Needs Review Doc';
}

function foleo_v1_get_workflow_type($post_id) {
  $value = sanitize_key((string) get_post_meta($post_id, 'foleo_workflow_type', true));
  if (!in_array($value, array('standard', 'custom_build'), true)) {
    $value = 'standard';
    update_post_meta($post_id, 'foleo_workflow_type', $value);
  }
  return $value;
}

function foleo_v1_is_library_item($post_id) {
  return get_post_meta($post_id, 'foleo_is_library_item', true) === '1';
}

function foleo_v1_base_preview_url($post_id) {
  return foleo_v1_detail_url($post_id);
}

function foleo_v1_workspace_branding_exists() {
  $tokens_json = get_option('foleo_admin_tokens_json', array());
  if (is_array($tokens_json) && !empty($tokens_json['tokens']) && is_array($tokens_json['tokens'])) {
    return true;
  }

  $tokens_css = get_option('foleo_admin_tokens_css', '');
  if (is_string($tokens_css) && trim($tokens_css) !== '') {
    return true;
  }

  return false;
}

function foleo_v1_template_registry() {
  $base = trailingslashit(plugin_dir_path(FOLEO_CORE_FILE)) . 'assets/templates/';
  return array(
    'thought_leadership_v1' => array(
      'docx_template_path' => $base . 'thought_leadership_v1.docx',
      'export_map' => 'locked_v1',
      'import_map' => 'locked_v1',
      'mode' => 'locked',
    ),
    'account_brief_v1' => array(
      'docx_template_path' => $base . 'account_brief_v1.docx',
      'export_map' => 'locked_v1',
      'import_map' => 'locked_v1',
      'mode' => 'locked',
    ),
    'proposal_brief_v1' => array(
      'docx_template_path' => $base . 'proposal_brief_v1.docx',
      'export_map' => 'locked_v1',
      'import_map' => 'locked_v1',
      'mode' => 'locked',
    ),
    'custom_packet_v1' => array(
      'docx_template_path' => $base . 'custom_packet_v1.docx',
      'export_map' => 'packet_v1',
      'import_map' => 'packet_v1',
      'mode' => 'packet',
    ),
  );
}

function foleo_v1_default_template_id_from_page_set($page_set) {
  $page_set = sanitize_key((string) $page_set);
  $map = array(
    'thought_leadership' => 'thought_leadership_v1',
    'account_brief' => 'account_brief_v1',
    'proposal_brief' => 'proposal_brief_v1',
  );
  return isset($map[$page_set]) ? $map[$page_set] : 'custom_packet_v1';
}

function foleo_v1_get_template_id($post_id, $page_set = '') {
  $registry = foleo_v1_template_registry();
  $stored = get_post_meta($post_id, 'foleo_template_id', true);
  $stored = sanitize_key((string) $stored);
  if ($stored !== '' && isset($registry[$stored])) {
    return $stored;
  }

  if ($page_set === '') {
    $page_set = get_post_meta($post_id, 'foleo_page_set', true);
  }
  $derived = foleo_v1_default_template_id_from_page_set($page_set);
  update_post_meta($post_id, 'foleo_template_id', $derived);
  return $derived;
}

function foleo_v1_template_labels() {
  return array(
    'thought_leadership_v1' => 'Thought Leadership v1',
    'account_brief_v1' => 'Account Brief v1',
    'proposal_brief_v1' => 'Proposal Brief v1',
    'custom_packet_v1' => 'Custom Content Packet v1',
  );
}

function foleo_v1_docx_fill_template($template_path, $replacements) {
  if (!class_exists('ZipArchive') || !is_string($template_path) || !is_readable($template_path)) {
    return new WP_Error('template_missing', 'Template not available.');
  }

  $tmp = wp_tempnam(basename($template_path));
  if (!$tmp) {
    return new WP_Error('tmp_failed', 'Could not prepare temporary file.');
  }
  if (!copy($template_path, $tmp)) {
    @unlink($tmp);
    return new WP_Error('copy_failed', 'Could not prepare export document.');
  }

  $zip = new ZipArchive();
  if ($zip->open($tmp) !== true) {
    @unlink($tmp);
    return new WP_Error('zip_open_failed', 'Could not open template document.');
  }

  $xml = $zip->getFromName('word/document.xml');
  if (!is_string($xml) || $xml === '') {
    $zip->close();
    @unlink($tmp);
    return new WP_Error('template_invalid', 'Template document is invalid.');
  }

  // Constraint: placeholders must remain in single w:t runs in template DOCX files.
  // Split-run placeholders are not reconstructed in this lightweight v0 filler.
  foreach ((array) $replacements as $key => $value) {
    $token = '{{' . sanitize_key((string) $key) . '}}';
    $safe = htmlspecialchars((string) $value, ENT_QUOTES | ENT_XML1, 'UTF-8');
    $xml = str_replace($token, $safe, $xml);
  }

  if (!$zip->addFromString('word/document.xml', $xml)) {
    $zip->close();
    @unlink($tmp);
    return new WP_Error('template_write_failed', 'Could not write export document.');
  }
  $zip->close();

  return $tmp;
}

function foleo_v1_get_structured_template_map() {
  return array(
    'TITLE' => array('path' => 'title', 'required' => true),
    'HERO_HEADLINE' => array('path' => 'hero.headline', 'required' => true),
    'HERO_SUBHEAD' => array('path' => 'hero.subhead', 'required' => true),
    'SECTION1_HEADING' => array('path' => 'sections.0.heading', 'required' => true),
    'SECTION1_BODY' => array('path' => 'sections.0.body', 'required' => true),
    'SECTION1_BULLET_1' => array('path' => 'sections.0.bullets.0', 'required' => false),
    'SECTION1_BULLET_2' => array('path' => 'sections.0.bullets.1', 'required' => false),
    'SECTION1_BULLET_3' => array('path' => 'sections.0.bullets.2', 'required' => false),
    'SECTION2_HEADING' => array('path' => 'sections.1.heading', 'required' => false),
    'SECTION2_BODY' => array('path' => 'sections.1.body', 'required' => false),
    'SECTION2_BULLET_1' => array('path' => 'sections.1.bullets.0', 'required' => false),
    'SECTION2_BULLET_2' => array('path' => 'sections.1.bullets.1', 'required' => false),
    'SECTION2_BULLET_3' => array('path' => 'sections.1.bullets.2', 'required' => false),
    'SECTION3_HEADING' => array('path' => 'sections.2.heading', 'required' => false),
    'SECTION3_BODY' => array('path' => 'sections.2.body', 'required' => false),
    'SECTION3_BULLET_1' => array('path' => 'sections.2.bullets.0', 'required' => false),
    'SECTION3_BULLET_2' => array('path' => 'sections.2.bullets.1', 'required' => false),
    'SECTION3_BULLET_3' => array('path' => 'sections.2.bullets.2', 'required' => false),
  );
}

function foleo_v1_get_template_map($map_id) {
  $map_id = sanitize_key((string) $map_id);
  if ($map_id === 'locked_v1') {
    return foleo_v1_get_structured_template_map();
  }
  return array();
}

function foleo_v1_build_structured_replacements($post, $payload, $template_id) {
  $payload = is_array($payload) ? $payload : foleo_v1_default_draft_payload($post);
  $hero = isset($payload['hero']) && is_array($payload['hero']) ? $payload['hero'] : array();
  $sections = isset($payload['sections']) && is_array($payload['sections']) ? $payload['sections'] : array();
  $title = isset($payload['title']) ? (string) $payload['title'] : '';
  if ($title === '') {
    $title = get_the_title($post);
  }

  $out = array(
    'template_id' => $template_id,
    'title' => $title,
    'hero_headline' => isset($hero['headline']) ? (string) $hero['headline'] : '',
    'hero_subhead' => isset($hero['subhead']) ? (string) $hero['subhead'] : '',
  );

  for ($i = 0; $i < 3; $i++) {
    $section = isset($sections[$i]) && is_array($sections[$i]) ? $sections[$i] : array();
    $out['section' . ($i + 1) . '_heading'] = isset($section['heading']) ? (string) $section['heading'] : '';
    $out['section' . ($i + 1) . '_body'] = isset($section['body']) ? (string) $section['body'] : '';
    $bullets = isset($section['bullets']) && is_array($section['bullets']) ? $section['bullets'] : array();
    for ($j = 0; $j < 3; $j++) {
      $out['section' . ($i + 1) . '_bullet_' . ($j + 1)] = isset($bullets[$j]) ? (string) $bullets[$j] : '';
    }
  }

  return $out;
}

function foleo_v1_build_open_replacements($post, $payload, $template_id) {
  $payload = is_array($payload) ? $payload : foleo_v1_default_draft_payload($post);
  $hero = isset($payload['hero']) && is_array($payload['hero']) ? $payload['hero'] : array();
  $sections = isset($payload['sections']) && is_array($payload['sections']) ? $payload['sections'] : array();
  $title = isset($payload['title']) ? (string) $payload['title'] : '';
  if ($title === '') {
    $title = get_the_title($post);
  }

  $packet_lines = array();
  foreach (array_slice($sections, 0, 3) as $section) {
    if (!is_array($section)) {
      continue;
    }
    $heading = isset($section['heading']) ? trim((string) $section['heading']) : '';
    $body = isset($section['body']) ? trim((string) $section['body']) : '';
    if ($heading !== '') {
      $packet_lines[] = strtoupper($heading) . ':';
    }
    if ($body !== '') {
      $packet_lines[] = $body;
    }
    $bullets = isset($section['bullets']) && is_array($section['bullets']) ? $section['bullets'] : array();
    foreach (array_slice($bullets, 0, 5) as $bullet) {
      $bullet = trim((string) $bullet);
      if ($bullet !== '') {
        $packet_lines[] = '- ' . $bullet;
      }
    }
    if ($heading !== '' || $body !== '' || !empty($bullets)) {
      $packet_lines[] = '';
    }
  }

  return array(
    'template_id' => $template_id,
    'title' => $title,
    'hero_headline' => isset($hero['headline']) ? (string) $hero['headline'] : '',
    'hero_subhead' => isset($hero['subhead']) ? (string) $hero['subhead'] : '',
    'content_packet' => trim(implode("\n", $packet_lines)),
  );
}

function foleo_v1_parse_structured_doc_payload($post, $raw_text, $version, $map) {
  $raw_text = is_string($raw_text) ? trim($raw_text) : '';
  if ($raw_text === '') {
    return new WP_Error('missing_required_fields', 'Missing required structured fields.');
  }

  $rows = array();
  foreach (preg_split('/\R/u', $raw_text) as $line) {
    $line = trim((string) $line);
    if ($line === '') {
      continue;
    }
    if (preg_match('/^([A-Z0-9_]+)\s*:\s*(.*)$/', $line, $m)) {
      $rows[$m[1]] = sanitize_text_field($m[2]);
    }
  }

  $map = is_array($map) ? $map : array();
  if (empty($map)) {
    return new WP_Error('missing_required_fields', 'Missing Review Doc mapping for structured import.');
  }
  $missing = array();
  foreach ($map as $label => $cfg) {
    if (!empty($cfg['required']) && (!isset($rows[$label]) || trim((string) $rows[$label]) === '')) {
      $missing[] = $label;
    }
  }
  if (!empty($missing)) {
    return new WP_Error('missing_required_fields', 'Missing required structured fields: ' . implode(', ', $missing));
  }

  $payload = foleo_v1_default_draft_payload($post);
  $payload['meta_note'] = 'Last generated from Review Doc: v' . absint($version);

  foreach ($map as $label => $cfg) {
    if (!isset($rows[$label])) {
      continue;
    }
    $value = trim((string) $rows[$label]);
    if ($value === '') {
      continue;
    }
    $path = explode('.', (string) $cfg['path']);
    if (count($path) === 1 && $path[0] === 'title') {
      $payload['title'] = $value;
      continue;
    }
    if ($path[0] === 'hero' && isset($path[1])) {
      if (!isset($payload['hero']) || !is_array($payload['hero'])) {
        $payload['hero'] = array();
      }
      $payload['hero'][$path[1]] = $value;
      continue;
    }
    if ($path[0] === 'sections' && isset($path[1], $path[2])) {
      $s = absint($path[1]);
      if (!isset($payload['sections'][$s]) || !is_array($payload['sections'][$s])) {
        $payload['sections'][$s] = array(
          'heading' => '',
          'body' => '',
          'bullets' => array(),
        );
      }
      if ($path[2] === 'heading' || $path[2] === 'body') {
        $payload['sections'][$s][$path[2]] = $value;
      } elseif ($path[2] === 'bullets' && isset($path[3])) {
        $b = absint($path[3]);
        if (!isset($payload['sections'][$s]['bullets']) || !is_array($payload['sections'][$s]['bullets'])) {
          $payload['sections'][$s]['bullets'] = array();
        }
        $payload['sections'][$s]['bullets'][$b] = $value;
      }
    }
  }

  $sections = array();
  foreach ((array) $payload['sections'] as $section) {
    if (!is_array($section)) {
      continue;
    }
    $heading = isset($section['heading']) ? sanitize_text_field((string) $section['heading']) : '';
    $body = isset($section['body']) ? sanitize_text_field((string) $section['body']) : '';
    $bullets = isset($section['bullets']) && is_array($section['bullets']) ? array_values(array_filter(array_map(function ($v) {
      $v = sanitize_text_field((string) $v);
      return $v === '' ? null : $v;
    }, $section['bullets']))) : array();
    if ($heading === '' && $body === '' && empty($bullets)) {
      continue;
    }
    $sections[] = array(
      'heading' => $heading,
      'body' => $body,
      'bullets' => $bullets,
    );
  }
  if (empty($sections)) {
    return new WP_Error('missing_required_fields', 'Missing required structured sections.');
  }
  $payload['sections'] = array_values(array_slice($sections, 0, 3));

  return $payload;
}

function foleo_v1_default_draft_payload($post = null) {
  $title = 'FOLEO Draft';
  if ($post instanceof WP_Post) {
    $post_title = trim((string) get_the_title($post));
    if ($post_title !== '') {
      $title = $post_title;
    }
  }

  return array(
    'title' => $title,
    'meta_note' => '',
    'hero' => array(
      'headline' => 'A smarter approach for your next FOLEO',
      'subhead' => 'This draft preview is generated from FOLEO JSON metadata.',
      'cta' => array(
        'text' => 'Request Review',
        'href' => '#',
      ),
    ),
    'sections' => array(
      array(
        'heading' => 'What this FOLEO covers',
        'body' => 'A concise overview of goals, scope, and expected outcomes.',
        'bullets' => array(
          'Project objective alignment',
          'Audience and constraints',
          'Primary success criteria',
        ),
      ),
      array(
        'heading' => 'Why it matters',
        'body' => 'A short proof section showing credibility and readiness.',
        'bullets' => array(
          'Measurable outcomes',
          'Relevant past results',
          'Clear implementation path',
        ),
      ),
    ),
  );
}

function foleo_v1_parse_draft_payload($raw, $post = null) {
  $defaults = foleo_v1_default_draft_payload($post);
  $data = is_string($raw) ? json_decode($raw, true) : null;
  if (!is_array($data)) {
    return $defaults;
  }

  $title = isset($data['title']) ? sanitize_text_field((string) $data['title']) : $defaults['title'];
  if ($title === '') {
    $title = $defaults['title'];
  }

  $hero_data = isset($data['hero']) && is_array($data['hero']) ? $data['hero'] : array();
  $headline = isset($hero_data['headline']) ? sanitize_text_field((string) $hero_data['headline']) : $defaults['hero']['headline'];
  $subhead = isset($hero_data['subhead']) ? sanitize_text_field((string) $hero_data['subhead']) : $defaults['hero']['subhead'];
  $cta_text = isset($hero_data['cta']['text']) ? sanitize_text_field((string) $hero_data['cta']['text']) : $defaults['hero']['cta']['text'];
  $cta_href = isset($hero_data['cta']['href']) ? esc_url_raw((string) $hero_data['cta']['href']) : $defaults['hero']['cta']['href'];
  if ($cta_href === '') {
    $cta_href = '#';
  }

  $sections = array();
  if (isset($data['sections']) && is_array($data['sections'])) {
    foreach (array_slice($data['sections'], 0, 3) as $section) {
      if (!is_array($section)) {
        continue;
      }
      $heading = isset($section['heading']) ? sanitize_text_field((string) $section['heading']) : '';
      $body = isset($section['body']) ? sanitize_text_field((string) $section['body']) : '';
      $bullets = array();
      if (isset($section['bullets']) && is_array($section['bullets'])) {
        foreach (array_slice($section['bullets'], 0, 5) as $bullet) {
          $clean = sanitize_text_field((string) $bullet);
          if ($clean !== '') {
            $bullets[] = $clean;
          }
        }
      }
      if ($heading !== '' || $body !== '' || !empty($bullets)) {
        $sections[] = array(
          'heading' => $heading,
          'body' => $body,
          'bullets' => $bullets,
        );
      }
    }
  }
  if (empty($sections)) {
    $sections = $defaults['sections'];
  }

  $meta_note = isset($data['meta_note']) ? sanitize_text_field((string) $data['meta_note']) : '';

  return array(
    'title' => $title,
    'meta_note' => $meta_note,
    'hero' => array(
      'headline' => $headline,
      'subhead' => $subhead,
      'cta' => array(
        'text' => $cta_text !== '' ? $cta_text : $defaults['hero']['cta']['text'],
        'href' => $cta_href,
      ),
    ),
    'sections' => $sections,
  );
}

function foleo_v1_ensure_draft_meta_defaults($post_id) {
  $post = get_post($post_id);
  if (!($post instanceof WP_Post) || $post->post_type !== 'foleo_page') {
    return '';
  }

  $token = get_post_meta($post_id, 'foleo_draft_token', true);
  $token = is_string($token) ? trim($token) : '';
  if ($token === '') {
    $token = foleo_v1_generate_draft_token();
    update_post_meta($post_id, 'foleo_draft_token', $token);
  }

  $json = get_post_meta($post_id, 'foleo_draft_json', true);
  $json = is_string($json) ? trim($json) : '';
  if ($json === '') {
    update_post_meta($post_id, 'foleo_draft_json', wp_json_encode(foleo_v1_default_draft_payload($post)));
  }

  return $token;
}

function foleo_v1_limit_text($value, $max) {
  $value = trim((string) $value);
  if ($value === '') {
    return '';
  }
  if (function_exists('mb_strlen') && function_exists('mb_substr')) {
    if (mb_strlen($value) <= $max) {
      return $value;
    }
    return rtrim(mb_substr($value, 0, $max - 1)) . '…';
  }
  if (strlen($value) <= $max) {
    return $value;
  }
  return rtrim(substr($value, 0, $max - 1)) . '…';
}

function foleo_v1_is_heading_line($line) {
  $line = trim((string) $line);
  if ($line === '') {
    return false;
  }
  if (substr($line, -1) === ':') {
    return true;
  }
  if (!preg_match('/[A-Za-z]/', $line)) {
    return false;
  }
  return strtoupper($line) === $line;
}

function foleo_v1_docx_extract_text($file_path) {
  $file_path = is_string($file_path) ? $file_path : '';
  if ($file_path === '' || !is_readable($file_path) || !class_exists('ZipArchive')) {
    return '';
  }

  $zip = new ZipArchive();
  if ($zip->open($file_path) !== true) {
    return '';
  }

  $xml = $zip->getFromName('word/document.xml');
  $zip->close();
  if (!is_string($xml) || $xml === '') {
    return '';
  }

  $xml = str_replace(array('</w:p>', '</w:tr>', '<w:br/>', '<w:br />', '<w:cr/>', '<w:cr />'), "\n", $xml);
  $xml = preg_replace('/<w:tab[^>]*\/>/', "\t", $xml);
  $xml = html_entity_decode(wp_strip_all_tags($xml), ENT_QUOTES | ENT_XML1, 'UTF-8');
  if (!is_string($xml) || trim($xml) === '') {
    return '';
  }

  $lines = preg_split('/\R/u', $xml);
  $clean = array();
  foreach ((array) $lines as $line) {
    $line = preg_replace('/\s+/u', ' ', trim((string) $line));
    if ($line === '') {
      continue;
    }
    $clean[] = $line;
  }

  return trim(implode("\n", $clean));
}

function foleo_v1_build_draft_payload_from_review_doc($post, $raw_text, $version) {
  $fallback = foleo_v1_default_draft_payload($post);
  $title = isset($fallback['title']) ? $fallback['title'] : 'FOLEO Draft';
  $version_label = 'Last generated from Review Doc: v' . absint($version);

  $raw_text = is_string($raw_text) ? trim($raw_text) : '';
  if ($raw_text === '') {
    return array(
      'title' => $title,
      'meta_note' => $version_label,
      'hero' => array(
        'headline' => 'Could not parse doc',
        'subhead' => 'Upload succeeded, but readable DOCX content was not available.',
        'cta' => array(
          'text' => 'View FOLEO Detail',
          'href' => '#',
        ),
      ),
      'sections' => array(
        array(
          'heading' => 'Review Doc',
          'body' => 'Could not parse doc.',
          'bullets' => array(),
        ),
      ),
    );
  }

  $lines = preg_split('/\R/u', $raw_text);
  $lines = array_values(array_filter(array_map(function ($line) {
    return trim((string) $line);
  }, (array) $lines)));
  if (empty($lines)) {
    return foleo_v1_build_draft_payload_from_review_doc($post, '', $version);
  }

  $headline = foleo_v1_limit_text($lines[0], 80);
  $subhead_parts = array_slice($lines, 1, 2);
  $subhead = foleo_v1_limit_text(implode(' ', $subhead_parts), 180);
  if ($subhead === '') {
    $subhead = 'Generated from the latest Review Doc upload.';
  }

  $sections = array();
  $count = count($lines);
  $i = 1;
  while ($i < $count && count($sections) < 3) {
    while ($i < $count && trim((string) $lines[$i]) === '') {
      $i++;
    }
    if ($i >= $count) {
      break;
    }

    $heading = '';
    if (foleo_v1_is_heading_line($lines[$i])) {
      $heading = rtrim(trim((string) $lines[$i]), ':');
      $i++;
    } else {
      $heading = 'Section ' . (count($sections) + 1);
    }

    $body_parts = array();
    $bullets = array();
    while ($i < $count) {
      $line = trim((string) $lines[$i]);
      if ($line === '') {
        $i++;
        continue;
      }
      if (foleo_v1_is_heading_line($line)) {
        break;
      }
      if (preg_match('/^\s*[\-\*\x{2022}]\s*(.+)$/u', $line, $m)) {
        if (count($bullets) < 5) {
          $bullet = sanitize_text_field((string) $m[1]);
          if ($bullet !== '') {
            $bullets[] = foleo_v1_limit_text($bullet, 140);
          }
        }
      } else {
        $body_parts[] = sanitize_text_field($line);
      }
      $i++;
    }

    $body = foleo_v1_limit_text(implode(' ', $body_parts), 280);
    if ($heading === '' && $body === '' && empty($bullets)) {
      continue;
    }
    $sections[] = array(
      'heading' => foleo_v1_limit_text($heading, 80),
      'body' => $body,
      'bullets' => $bullets,
    );
  }

  if (empty($sections)) {
    $sections[] = array(
      'heading' => 'Review Doc',
      'body' => foleo_v1_limit_text(implode(' ', array_slice($lines, 1)), 280),
      'bullets' => array(),
    );
  }

  return array(
    'title' => $title,
    'meta_note' => $version_label,
    'hero' => array(
      'headline' => $headline,
      'subhead' => $subhead,
      'cta' => array(
        'text' => 'View FOLEO Detail',
        'href' => '#',
      ),
    ),
    'sections' => $sections,
  );
}

function foleo_v1_refresh_draft_json_from_review_doc($post_id, $attachment_id, $version) {
  $post = get_post($post_id);
  if (!($post instanceof WP_Post) || $post->post_type !== 'foleo_page') {
    return;
  }

  foleo_v1_ensure_draft_meta_defaults($post_id);
  $path = get_attached_file($attachment_id);
  $text = foleo_v1_docx_extract_text(is_string($path) ? $path : '');
  $payload = foleo_v1_build_draft_payload_from_review_doc($post, $text, $version);
  update_post_meta($post_id, 'foleo_draft_json', wp_json_encode($payload));
}

function foleo_v1_draft_url($token) {
  $token = preg_replace('/[^A-Za-z0-9]/', '', (string) $token);
  if ($token === '') {
    return '';
  }
  return site_url('/draft/' . rawurlencode($token));
}

function foleo_v1_draft_404() {
  global $wp_query;
  if ($wp_query) {
    $wp_query->set_404();
  }
  status_header(404);
  nocache_headers();
  $template = get_404_template();
  if ($template) {
    include $template;
    exit;
  }
  wp_die('Not Found', 404);
}

add_action('init', function () {
  add_rewrite_rule(
    '^draft/([A-Za-z0-9]+)/?$',
    'index.php?foleo_draft_token=$matches[1]',
    'top'
  );
});

add_filter('query_vars', function ($vars) {
  $vars[] = 'foleo_draft_token';
  return $vars;
});

add_action('init', function () {
  $stored_version = get_option('foleo_draft_rewrite_version');
  if ($stored_version === false) {
    update_option('foleo_rewrite_needs_flush', '1', true);
    update_option('foleo_draft_rewrite_version', FOLEO_DRAFT_REWRITE_VERSION, true);
  }
});

add_action('wp_loaded', function () {
  if (!is_admin() || is_network_admin()) {
    return;
  }
  if (!is_user_logged_in()) {
    return;
  }
  if (!foleo_is_admin_user() && !foleo_is_client_shell_context()) {
    return;
  }

  $stored_version = get_option('foleo_draft_rewrite_version');
  if ($stored_version !== FOLEO_DRAFT_REWRITE_VERSION) {
    update_option('foleo_rewrite_needs_flush', '1', true);
    update_option('foleo_draft_rewrite_version', FOLEO_DRAFT_REWRITE_VERSION, true);
  }

  if (get_option('foleo_rewrite_needs_flush') !== '1') {
    return;
  }

  flush_rewrite_rules(false);
  update_option('foleo_rewrite_needs_flush', '0', true);
}, 15);

add_action('template_redirect', function () {
  $token = get_query_var('foleo_draft_token');
  if (!is_string($token) || $token === '') {
    return;
  }

  $token = preg_replace('/[^A-Za-z0-9]/', '', $token);
  if ($token === '') {
    foleo_v1_draft_404();
  }

  $posts = get_posts(array(
    'post_type' => 'foleo_page',
    'post_status' => array('publish', 'draft', 'pending', 'future', 'private'),
    'posts_per_page' => 1,
    'fields' => 'ids',
    'meta_key' => 'foleo_draft_token',
    'meta_value' => $token,
    'no_found_rows' => true,
    'suppress_filters' => true,
  ));
  if (empty($posts)) {
    foleo_v1_draft_404();
  }

  $post_id = (int) $posts[0];
  $post = get_post($post_id);
  if (!($post instanceof WP_Post)) {
    foleo_v1_draft_404();
  }

  $raw_json = get_post_meta($post_id, 'foleo_draft_json', true);
  $payload = foleo_v1_parse_draft_payload($raw_json, $post);
  $title = isset($payload['title']) ? (string) $payload['title'] : 'FOLEO Draft';
  $hero = isset($payload['hero']) && is_array($payload['hero']) ? $payload['hero'] : array();
  $sections = isset($payload['sections']) && is_array($payload['sections']) ? $payload['sections'] : array();

  nocache_headers();
  status_header(200);
  header('Content-Type: text/html; charset=' . get_bloginfo('charset'));

  echo '<!doctype html><html lang="en"><head><meta charset="utf-8">';
  echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
  echo '<title>' . esc_html($title) . '</title>';
  echo '<style>body{margin:0;font-family:Avenir,\"Avenir Next\",Arial,sans-serif;background:#f2f4f7;color:#0f172a}main{max-width:980px;margin:0 auto;padding:32px 20px 56px}.hero,.section{background:#fff;border:1px solid #e3e7ee;border-radius:12px;padding:24px;box-shadow:0 1px 2px rgba(15,23,42,.05)}.hero h1{margin:0 0 8px;font-size:34px;line-height:1.15}.hero p{margin:0 0 16px;color:#334155}.cta{display:inline-block;padding:10px 16px;border:1px solid #2563eb;border-radius:6px;color:#2563eb;text-decoration:none;font-weight:600}.grid{display:grid;gap:14px;margin-top:14px}.section h2{margin:0 0 8px;font-size:20px}.section p{margin:0 0 8px;color:#334155}.section ul{margin:0;padding-left:18px}.meta{margin-bottom:12px;color:#64748b;font-size:13px}</style>';
  echo '</head><body><main>';
  $meta_note = isset($payload['meta_note']) ? sanitize_text_field((string) $payload['meta_note']) : '';
  echo '<div class="meta">Draft Preview' . ($meta_note !== '' ? ' - ' . esc_html($meta_note) : '') . '</div>';
  echo '<section class="hero">';
  echo '<h1>' . esc_html(isset($hero['headline']) ? (string) $hero['headline'] : '') . '</h1>';
  echo '<p>' . esc_html(isset($hero['subhead']) ? (string) $hero['subhead'] : '') . '</p>';
  $cta_text = isset($hero['cta']['text']) ? (string) $hero['cta']['text'] : 'Learn More';
  $cta_href = isset($hero['cta']['href']) ? esc_url((string) $hero['cta']['href']) : '#';
  if ($cta_href === '') {
    $cta_href = '#';
  }
  echo '<a class="cta" href="' . $cta_href . '">' . esc_html($cta_text) . '</a>';
  echo '</section>';
  echo '<div class="grid">';
  foreach (array_slice($sections, 0, 3) as $section) {
    if (!is_array($section)) {
      continue;
    }
    $heading = isset($section['heading']) ? (string) $section['heading'] : '';
    $body = isset($section['body']) ? (string) $section['body'] : '';
    $bullets = isset($section['bullets']) && is_array($section['bullets']) ? $section['bullets'] : array();
    echo '<section class="section">';
    if ($heading !== '') {
      echo '<h2>' . esc_html($heading) . '</h2>';
    }
    if ($body !== '') {
      echo '<p>' . esc_html($body) . '</p>';
    }
    if (!empty($bullets)) {
      echo '<ul>';
      foreach ($bullets as $bullet) {
        $bullet = sanitize_text_field((string) $bullet);
        if ($bullet === '') {
          continue;
        }
        echo '<li>' . esc_html($bullet) . '</li>';
      }
      echo '</ul>';
    }
    echo '</section>';
  }
  echo '</div>';
  echo '</main></body></html>';
  exit;
});

function foleo_v1_get_review_doc_versions($post_id) {
  $raw = get_post_meta($post_id, 'foleo_review_doc_versions', true);
  if (!is_array($raw)) {
    return array();
  }

  $versions = array();
  foreach ($raw as $entry) {
    if (!is_array($entry)) {
      continue;
    }

    $version = isset($entry['version']) ? absint($entry['version']) : 0;
    $attachment_id = isset($entry['attachment_id']) ? absint($entry['attachment_id']) : 0;
    if ($version <= 0 || $attachment_id <= 0) {
      continue;
    }

    $versions[] = array(
      'version' => $version,
      'attachment_id' => $attachment_id,
      'created_at' => isset($entry['created_at']) ? absint($entry['created_at']) : 0,
      'user_id' => isset($entry['user_id']) ? absint($entry['user_id']) : 0,
      'filename' => isset($entry['filename']) ? sanitize_text_field((string) $entry['filename']) : '',
    );
  }

  usort($versions, function ($a, $b) {
    return (int) $b['version'] <=> (int) $a['version'];
  });

  return $versions;
}

function foleo_v1_review_doc_upload_url($post_id, $args = array()) {
  $base = array(
    'page' => 'foleo-v1-detail',
    'foleo_page_id' => absint($post_id),
  );
  return add_query_arg(array_merge($base, $args), admin_url('admin.php'));
}

function foleo_v1_redirect($url) {
  $url = esc_url_raw($url);
  if (wp_safe_redirect($url)) {
    exit;
  }

  echo '<script>window.location.href=' . wp_json_encode($url) . ';</script>';
  exit;
}

add_filter('post_row_actions', function ($actions, $post) {
  if (!foleo_is_client_shell_context()) {
    return $actions;
  }
  if (!($post instanceof WP_Post) || $post->post_type !== 'foleo_page') {
    return $actions;
  }
  if (!current_user_can('edit_post', $post->ID)) {
    return $actions;
  }

  return array();
}, 20, 2);

add_filter('get_edit_post_link', function ($link, $post_id, $context) {
  if (!foleo_is_client_shell_context()) {
    return $link;
  }
  if (get_post_type($post_id) !== 'foleo_page') {
    return $link;
  }
  if (!current_user_can('edit_post', $post_id)) {
    return $link;
  }
  return foleo_v1_detail_url($post_id);
}, 20, 3);

add_filter('display_post_states', function ($post_states, $post) {
  if (!foleo_is_client_shell_context()) {
    return $post_states;
  }
  if (!($post instanceof WP_Post) || $post->post_type !== 'foleo_page') {
    return $post_states;
  }
  return array();
}, 30, 2);

add_action('admin_menu', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  add_submenu_page(
    'index.php',
    'Workspace',
    'Workspace',
    'read',
    'foleo-workspace',
    'foleo_render_workspace_shell'
  );

  add_submenu_page(
    'index.php',
    'FOLEOs',
    'FOLEOs',
    'edit_posts',
    'edit.php?post_type=foleo_page'
  );

  add_submenu_page(
    'index.php',
    'Assets',
    'Assets',
    'read',
    'foleo-assets',
    'foleo_render_assets_shell'
  );

  add_submenu_page(
    'index.php',
    'Setup',
    'Setup',
    'read',
    'foleo-setup',
    'foleo_render_setup_shell'
  );

  add_submenu_page(
    'index.php',
    'Build FOLEO',
    'Build FOLEO',
    'edit_posts',
    'foleo-v1-detail',
    'foleo_render_v1_detail_shell'
  );

  add_submenu_page(
    'index.php',
    'New FOLEO',
    'New FOLEO',
    'edit_posts',
    'foleo-v1-new',
    'foleo_render_v1_new_shell'
  );
}, 1100);

add_filter('parent_file', function ($parent_file) {
  if (!foleo_is_client_shell_context()) {
    return $parent_file;
  }
  if (foleo_v1_is_foleo_list_screen()) {
    return 'index.php';
  }
  $page = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
  if (in_array($page, array('foleo-workspace', 'foleo-assets', 'foleo-setup'), true)) {
    return 'index.php';
  }
  if ($page === 'foleo-v1-detail' || $page === 'foleo-v1-new') {
    return '';
  }
  return $parent_file;
}, 20);

add_filter('submenu_file', function ($submenu_file, $parent_file) {
  if (!foleo_is_client_shell_context()) {
    return $submenu_file;
  }
  if (foleo_v1_is_foleo_list_screen()) {
    return 'edit.php?post_type=foleo_page';
  }
  if ($parent_file !== 'index.php') {
    return $submenu_file;
  }
  $page = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
  if ($page === 'foleo-assets') {
    return 'foleo-assets';
  }
  if ($page === 'foleo-setup') {
    return 'foleo-setup';
  }
  if ($page === 'foleo-v1-detail' || $page === 'foleo-v1-new') {
    return '';
  }
  return $submenu_file;
}, 20, 2);

add_action('pre_get_posts', function ($query) {
  if (!($query instanceof WP_Query) || !$query->is_main_query() || !is_admin()) {
    return;
  }
  if (!foleo_v1_is_foleo_list_screen()) {
    return;
  }

  $bucket = foleo_v1_get_bucket_filter();
  if (!in_array($bucket, array('published', 'draft'), true)) {
    return;
  }

  $query->set('foleo_bucket_filter', $bucket);
  $query->set('post_status', array('publish', 'draft', 'pending', 'future', 'private'));
});

add_filter('posts_where', function ($where, $query) {
  if (!($query instanceof WP_Query) || !is_admin()) {
    return $where;
  }

  $bucket = $query->get('foleo_bucket_filter');
  if (!in_array($bucket, array('published', 'draft'), true)) {
    return $where;
  }

  global $wpdb;
  $live_url_exists_sql = "EXISTS (
    SELECT 1
    FROM {$wpdb->postmeta} foleo_live_meta
    WHERE foleo_live_meta.post_id = {$wpdb->posts}.ID
      AND foleo_live_meta.meta_key = 'foleo_live_url'
      AND foleo_live_meta.meta_value <> ''
  )";

  if ($bucket === 'published') {
    $where .= " AND ({$wpdb->posts}.post_status = 'publish' OR {$live_url_exists_sql})";
  } else {
    $where .= " AND ({$wpdb->posts}.post_status <> 'publish' AND NOT {$live_url_exists_sql})";
  }

  return $where;
}, 10, 2);

add_filter('manage_edit-foleo_page_columns', function ($columns) {
  if (!foleo_v1_is_foleo_list_screen()) {
    return $columns;
  }

  $new = array();
  if (isset($columns['cb'])) {
    $new['cb'] = $columns['cb'];
  }
  $new['title'] = 'FOLEO Name';
  $new['foleo_seo_visibility'] = 'SEO Visibility';
  $new['foleo_status'] = 'Status';
  $new['foleo_get_url'] = 'Get URL';
  $new['foleo_primary_action'] = 'Actions';
  return $new;
}, 20);

add_action('manage_foleo_page_posts_custom_column', function ($column, $post_id) {
  if (!foleo_v1_is_foleo_list_screen()) {
    return;
  }

  $post = get_post($post_id);
  if (!($post instanceof WP_Post) || $post->post_type !== 'foleo_page') {
    return;
  }

  if ($column === 'foleo_seo_visibility') {
    $enabled = foleo_v1_is_public_seo_enabled($post_id);
    $base_url = remove_query_arg(array('foleo_seo_toggle', 'foleo_seo_value', 'foleo_seo_nonce'));
    $on_url = wp_nonce_url(
      add_query_arg(array(
        'foleo_seo_toggle' => absint($post_id),
        'foleo_seo_value' => 'on',
      ), $base_url),
      'foleo_v1_seo_toggle_' . $post_id . '_on',
      'foleo_seo_nonce'
    );
    $off_url = wp_nonce_url(
      add_query_arg(array(
        'foleo_seo_toggle' => absint($post_id),
        'foleo_seo_value' => 'off',
      ), $base_url),
      'foleo_v1_seo_toggle_' . $post_id . '_off',
      'foleo_seo_nonce'
    );

    echo '<div class="foleo-v1-list-seo-toggle">';
    echo '<a class="' . ($enabled ? 'is-active' : '') . '" href="' . esc_url($on_url) . '">On</a>';
    echo '<span>/</span>';
    echo '<a class="' . (!$enabled ? 'is-active' : '') . '" href="' . esc_url($off_url) . '">Off</a>';
    echo '</div>';
    return;
  }

  if ($column === 'foleo_status') {
    echo esc_html(foleo_v1_get_status_label($post));
    return;
  }

  if ($column === 'foleo_get_url') {
    $live_url = foleo_v1_get_live_url($post_id);
    $preview_url = foleo_v1_get_preview_url($post_id);
    $copy_url = $live_url !== '' ? $live_url : $preview_url;
    if ($copy_url !== '') {
      echo '<button type="button" class="button button-small foleo-ui-btn foleo-ui-btn--secondary foleo-v1-btn-action foleo-v1-btn-action--secondary foleo-v1-action-secondary foleo-v1-copy-url" data-copy-url="' . esc_attr($copy_url) . '">Get URL</button>';
    } else {
      echo '<span class="description">N/A</span>';
    }
    return;
  }

  if ($column === 'foleo_primary_action') {
    $live_url = foleo_v1_get_live_url($post_id);
    echo '<a class="button button-small foleo-ui-btn foleo-ui-btn--primary foleo-v1-btn-action foleo-v1-btn-action--primary foleo-v1-action-primary" href="' . esc_url(foleo_v1_detail_url($post_id)) . '">Edit</a> ';
    echo '<form method="post" action="' . esc_url(admin_url('admin.php?page=foleo-v1-new')) . '" class="foleo-v1__action-form">';
    wp_nonce_field('foleo_v1_new_clone', 'foleo_v1_new_nonce');
    echo '<input type="hidden" name="foleo_v1_action" value="foleo_v1_clone_from_base" />';
    echo '<input type="hidden" name="foleo_base_foleo_id" value="' . esc_attr((string) $post_id) . '" />';
    echo '<button type="submit" class="button button-small foleo-ui-btn foleo-ui-btn--secondary foleo-v1-btn-action foleo-v1-btn-action--secondary foleo-v1-action-secondary">Clone</button>';
    echo '</form> ';
    if ($live_url !== '') {
      echo '<a class="button button-small foleo-ui-btn foleo-ui-btn--secondary foleo-v1-btn-action foleo-v1-btn-action--secondary foleo-v1-action-secondary" href="' . esc_url($live_url) . '" target="_blank" rel="noopener noreferrer">View</a> ';
    } else {
      $preview_url = foleo_v1_get_preview_url($post_id);
      if ($preview_url !== '') {
        echo '<a class="button button-small foleo-ui-btn foleo-ui-btn--secondary foleo-v1-btn-action foleo-v1-btn-action--secondary foleo-v1-action-secondary" href="' . esc_url($preview_url) . '" target="_blank" rel="noopener noreferrer">Preview</a> ';
      } else {
        echo '<a class="button button-small foleo-ui-btn foleo-ui-btn--secondary foleo-v1-btn-action foleo-v1-btn-action--secondary foleo-v1-action-secondary" href="' . esc_url(foleo_v1_detail_url($post_id)) . '">Build</a> ';
      }
    }

    $delete_url = get_delete_post_link($post_id);
    if (is_string($delete_url) && $delete_url !== '') {
      echo '<a class="button button-small foleo-ui-btn foleo-ui-btn--secondary foleo-ui-btn--delete foleo-v1-btn-action foleo-v1-btn-action--secondary foleo-v1-btn-action--delete foleo-v1-action-secondary foleo-v1-action-delete" href="' . esc_url($delete_url) . '" aria-label="Delete FOLEO"><span class="dashicons dashicons-trash"></span></a>';
    }
  }
}, 10, 2);

add_action('admin_init', function () {
  if (!foleo_v1_is_foleo_list_screen()) {
    return;
  }

  $post_id = isset($_GET['foleo_seo_toggle']) ? absint($_GET['foleo_seo_toggle']) : 0;
  if ($post_id <= 0) {
    return;
  }

  $value = isset($_GET['foleo_seo_value']) ? sanitize_key(wp_unslash($_GET['foleo_seo_value'])) : '';
  if ($value !== 'on' && $value !== 'off') {
    return;
  }

  $nonce = isset($_GET['foleo_seo_nonce']) ? sanitize_text_field(wp_unslash($_GET['foleo_seo_nonce'])) : '';
  if (!$nonce || !wp_verify_nonce($nonce, 'foleo_v1_seo_toggle_' . $post_id . '_' . $value)) {
    wp_die('Forbidden', 403);
  }

  if (!current_user_can('edit_post', $post_id)) {
    wp_die('Forbidden', 403);
  }

  $enabled = $value === 'on' ? '1' : '0';
  update_post_meta($post_id, 'foleo_seo_enabled', $enabled);
  update_post_meta($post_id, 'foleo_public_seo_enabled', $enabled);
  update_post_meta($post_id, 'foleo_seo_visibility', $value);

  $redirect = remove_query_arg(array('foleo_seo_toggle', 'foleo_seo_value', 'foleo_seo_nonce'));
  wp_safe_redirect($redirect);
  exit;
}, 25);

add_filter('screen_options_show_screen', function ($show, $screen) {
  if (!foleo_v1_is_foleo_list_screen()) {
    return $show;
  }
  return false;
}, 20, 2);

add_action('current_screen', function ($screen) {
  if (!foleo_v1_is_foleo_list_screen()) {
    return;
  }
  if (is_object($screen) && method_exists($screen, 'remove_help_tabs')) {
    $screen->remove_help_tabs();
  }
});

add_action('admin_init', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  global $pagenow;
  if ($pagenow !== 'post-new.php') {
    return;
  }
  $post_type = isset($_GET['post_type']) ? sanitize_key(wp_unslash($_GET['post_type'])) : '';
  if ($post_type !== 'foleo_page') {
    return;
  }

  wp_safe_redirect(admin_url('admin.php?page=foleo-v1-new'));
  exit;
}, 5);

add_action('admin_init', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  global $pagenow;
  if ($pagenow !== 'post.php') {
    return;
  }

  $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;
  if ($post_id <= 0 || get_post_type($post_id) !== 'foleo_page') {
    return;
  }
  if (!current_user_can('edit_post', $post_id)) {
    wp_die('Forbidden', 403);
  }

  wp_safe_redirect(foleo_v1_detail_url($post_id));
  exit;
}, 6);

add_action('admin_init', function () {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return;
  }
  $page = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
  if ($page !== 'foleo-v1-new') {
    return;
  }
  if (!foleo_is_client_shell_context()) {
    wp_die('Forbidden', 403);
  }
  if (!current_user_can('edit_posts')) {
    wp_die('Forbidden', 403);
  }

  $action = isset($_POST['foleo_v1_action']) ? sanitize_key(wp_unslash($_POST['foleo_v1_action'])) : '';
  if ($action !== 'foleo_v1_clone_from_base') {
    wp_die('Forbidden', 403);
  }

  $nonce = isset($_POST['foleo_v1_new_nonce']) ? sanitize_text_field(wp_unslash($_POST['foleo_v1_new_nonce'])) : '';
  if (!$nonce || !wp_verify_nonce($nonce, 'foleo_v1_new_clone')) {
    wp_die('Forbidden', 403);
  }

  $base_id = isset($_POST['foleo_base_foleo_id']) ? absint($_POST['foleo_base_foleo_id']) : 0;
  $base = $base_id ? get_post($base_id) : null;
  if (!($base instanceof WP_Post) || $base->post_type !== 'foleo_page') {
    wp_die('Forbidden', 403);
  }
  if (!current_user_can('edit_post', $base_id)) {
    wp_die('Forbidden', 403);
  }

  $new_title = trim((string) get_the_title($base_id));
  $requested_name = isset($_POST['foleo_new_name']) ? sanitize_text_field(wp_unslash($_POST['foleo_new_name'])) : '';
  $requested_name = trim($requested_name);
  if ($requested_name !== '') {
    $new_title = $requested_name;
  } elseif ($new_title === '') {
    $new_title = 'FOLEO';
  } else {
    $new_title .= ' Copy';
  }

  $new_id = wp_insert_post(array(
    'post_type' => 'foleo_page',
    'post_status' => 'draft',
    'post_title' => $new_title,
  ), true);
  if (is_wp_error($new_id) || !$new_id) {
    wp_die('Could not create FOLEO.', 500);
  }

  $all_meta = get_post_meta($base_id);
  $skip_meta = array(
    'foleo_draft_token',
    'foleo_review_doc_versions',
    'foleo_base_foleo_id',
    'foleo_base_foleo_kind',
    'foleo_workflow_type',
    'foleo_is_library_item',
    'foleo_library_tier',
  );
  foreach ($all_meta as $meta_key => $values) {
    if (in_array($meta_key, $skip_meta, true)) {
      continue;
    }
    if (!is_array($values)) {
      continue;
    }
    foreach ($values as $meta_value) {
      add_post_meta($new_id, $meta_key, maybe_unserialize($meta_value));
    }
  }

  $is_library = foleo_v1_is_library_item($base_id);
  update_post_meta($new_id, 'foleo_workflow_type', 'standard');
  update_post_meta($new_id, 'foleo_base_foleo_id', $base_id);
  update_post_meta($new_id, 'foleo_base_foleo_kind', $is_library ? 'library' : 'yours');
  update_post_meta($new_id, 'foleo_is_library_item', '0');
  $intent_options = foleo_v1_intent_options();
  $intent = isset($_POST['foleo_intent']) ? sanitize_key(wp_unslash($_POST['foleo_intent'])) : foleo_v1_get_intent($base_id);
  if (!isset($intent_options[$intent])) {
    $intent = 'thought_leadership';
  }
  update_post_meta($new_id, 'foleo_intent', $intent);
  update_post_meta($new_id, 'foleo_page_set', $intent);
  $public_seo_enabled = isset($_POST['foleo_public_seo_enabled']) ? '1' : '0';
  $popup_enabled = isset($_POST['foleo_popup_enabled']) ? '1' : '0';
  update_post_meta($new_id, 'foleo_public_seo_enabled', $public_seo_enabled);
  update_post_meta($new_id, 'foleo_seo_enabled', $public_seo_enabled);
  update_post_meta($new_id, 'foleo_seo_visibility', $public_seo_enabled === '1' ? 'on' : 'off');
  if (isset($_POST['foleo_popup_enabled']) || array_key_exists('foleo_popup_enabled', $_POST)) {
    update_post_meta($new_id, 'foleo_popup_enabled', $popup_enabled);
  }
  delete_post_meta($new_id, 'foleo_review_doc_versions');
  foleo_v1_ensure_draft_meta_defaults($new_id);

  wp_safe_redirect(foleo_v1_detail_url($new_id));
  exit;
}, 20);

add_action('admin_init', function () {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return;
  }

  $page = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
  if ($page !== 'foleo-v1-detail') {
    return;
  }
  if (!foleo_is_client_shell_context()) {
    wp_die('Forbidden', 403);
  }

  $post_id = isset($_POST['foleo_page_id']) ? absint($_POST['foleo_page_id']) : 0;
  $post = $post_id ? get_post($post_id) : null;
  if (!($post instanceof WP_Post) || $post->post_type !== 'foleo_page') {
    wp_die('Forbidden', 403);
  }
  if (!current_user_can('edit_post', $post->ID)) {
    wp_die('Forbidden', 403);
  }

  $redirect = static function ($url) {
    wp_safe_redirect($url);
    exit;
  };

  $action = isset($_POST['foleo_v1_action']) ? sanitize_key(wp_unslash($_POST['foleo_v1_action'])) : 'review_status_save';
  $submit_intent = isset($_POST['foleo_submit_intent']) ? sanitize_key(wp_unslash($_POST['foleo_submit_intent'])) : 'save';
  if (!in_array($submit_intent, array('save', 'save_continue'), true)) {
    $submit_intent = 'save';
  }
  $is_continue = $submit_intent === 'save_continue';
  $template_registry = foleo_v1_template_registry();
  $current_template_id = foleo_v1_get_template_id($post->ID);
  $current_template = isset($template_registry[$current_template_id]) ? $template_registry[$current_template_id] : $template_registry['custom_packet_v1'];
  $current_mode = isset($current_template['mode']) ? sanitize_key((string) $current_template['mode']) : 'packet';

  if ($action === 'review_doc_export') {
    $nonce = isset($_POST['foleo_v1_export_nonce']) ? sanitize_text_field(wp_unslash($_POST['foleo_v1_export_nonce'])) : '';
    if (!$nonce || !wp_verify_nonce($nonce, 'foleo_v1_review_doc_export_' . $post->ID)) {
      wp_die('Forbidden', 403);
    }

    $raw_json = get_post_meta($post->ID, 'foleo_draft_json', true);
    $payload = foleo_v1_parse_draft_payload($raw_json, $post);
    if ($current_mode === 'locked') {
      $replacements = foleo_v1_build_structured_replacements($post, $payload, $current_template_id);
    } else {
      $replacements = foleo_v1_build_open_replacements($post, $payload, $current_template_id);
    }

    $docx_path = isset($current_template['docx_template_path']) ? (string) $current_template['docx_template_path'] : '';
    $rendered = foleo_v1_docx_fill_template($docx_path, $replacements);
    if (is_wp_error($rendered)) {
      $redirect(foleo_v1_review_doc_upload_url($post->ID, array(
        'artifact' => 'review_doc',
        'error' => 'export_failed',
      )));
    }

    $download_name = sanitize_title(get_the_title($post)) . '-' . $current_template_id . '.docx';
    if ($download_name === '-' . $current_template_id . '.docx') {
      $download_name = 'foleo-' . $current_template_id . '.docx';
    }
    $download_name = str_replace(array("\r", "\n"), '', $download_name);

    if (headers_sent()) {
      @unlink($rendered);
      $redirect(foleo_v1_review_doc_upload_url($post->ID, array(
        'artifact' => 'review_doc',
        'error' => 'export_failed',
      )));
    }

    $size = @filesize($rendered);

    nocache_headers();
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="' . $download_name . '"');
    if (is_int($size) && $size > 0) {
      header('Content-Length: ' . $size);
    }
    @readfile($rendered);
    @unlink($rendered);
    exit;
  }

  if ($action === 'review_doc_upload') {
    $nonce = isset($_POST['foleo_v1_artifact_nonce']) ? sanitize_text_field(wp_unslash($_POST['foleo_v1_artifact_nonce'])) : '';
    if (!$nonce || !wp_verify_nonce($nonce, 'foleo_v1_review_doc_upload_' . $post->ID)) {
      wp_die('Forbidden', 403);
    }

    if (empty($_FILES['foleo_review_doc']) || !is_array($_FILES['foleo_review_doc'])) {
      $redirect(foleo_v1_review_doc_upload_url($post->ID, array(
        'artifact' => 'review_doc',
        'error' => 'missing_file',
      )));
    }

    $file = $_FILES['foleo_review_doc'];
    if (!empty($file['error']) || empty($file['name'])) {
      $redirect(foleo_v1_review_doc_upload_url($post->ID, array(
        'artifact' => 'review_doc',
        'error' => 'missing_file',
      )));
    }

    $filename = sanitize_file_name((string) $file['name']);
    $ext = strtolower((string) pathinfo($filename, PATHINFO_EXTENSION));
    $allowed_mime = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    $check = wp_check_filetype_and_ext((string) $file['tmp_name'], $filename, array(
      'docx' => $allowed_mime,
    ));

    if ($ext !== 'docx' || empty($check['ext']) || $check['ext'] !== 'docx' || empty($check['type']) || $check['type'] !== $allowed_mime) {
      $redirect(foleo_v1_review_doc_upload_url($post->ID, array(
        'artifact' => 'review_doc',
        'error' => 'invalid_type',
      )));
    }

    if (!function_exists('media_handle_upload')) {
      require_once ABSPATH . 'wp-admin/includes/file.php';
      require_once ABSPATH . 'wp-admin/includes/media.php';
      require_once ABSPATH . 'wp-admin/includes/image.php';
    }

    $attachment_id = media_handle_upload('foleo_review_doc', $post->ID, array(), array(
      'test_form' => false,
      'mimes' => array(
        'docx' => $allowed_mime,
      ),
    ));

    if (is_wp_error($attachment_id) || !$attachment_id) {
      $redirect(foleo_v1_review_doc_upload_url($post->ID, array(
        'artifact' => 'review_doc',
        'error' => 'upload_failed',
      )));
    }

    $versions = foleo_v1_get_review_doc_versions($post->ID);
    $max_version = 0;
    foreach ($versions as $entry) {
      $max_version = max($max_version, (int) $entry['version']);
    }
    $new_version = $max_version + 1;

    array_unshift($versions, array(
      'version' => $new_version,
      'attachment_id' => (int) $attachment_id,
      'created_at' => time(),
      'user_id' => get_current_user_id(),
      'filename' => $filename,
    ));

    update_post_meta($post->ID, 'foleo_review_doc_versions', $versions);
    $path = get_attached_file((int) $attachment_id);
    $raw_text = foleo_v1_docx_extract_text(is_string($path) ? $path : '');
    if ($current_mode === 'locked') {
      $map = foleo_v1_get_template_map(isset($current_template['import_map']) ? $current_template['import_map'] : '');
      $payload = foleo_v1_parse_structured_doc_payload($post, $raw_text, $new_version, $map);
      if (is_wp_error($payload)) {
        $error_msg = sanitize_text_field((string) $payload->get_error_message());
        $redirect(foleo_v1_review_doc_upload_url($post->ID, array(
          'artifact' => 'review_doc',
          'error' => 'structured_missing_required',
          'error_msg' => $error_msg,
        )));
      }
    } else {
      $payload = foleo_v1_build_draft_payload_from_review_doc($post, $raw_text, $new_version);
    }

    foleo_v1_ensure_draft_meta_defaults($post->ID);
    update_post_meta($post->ID, 'foleo_draft_json', wp_json_encode($payload));

    $redirect(foleo_v1_review_doc_upload_url($post->ID, array(
      'artifact' => 'review_doc',
      'uploaded' => 1,
      'version' => $new_version,
    )));
  }
  if ($action !== 'review_status_save') {
    wp_die('Forbidden', 403);
  }

  $nonce = isset($_POST['foleo_v1_nonce']) ? sanitize_text_field(wp_unslash($_POST['foleo_v1_nonce'])) : '';
  if (!$nonce || !wp_verify_nonce($nonce, 'foleo_v1_save_' . $post->ID)) {
    wp_die('Forbidden', 403);
  }

  $options = foleo_v1_review_options();
  $defaults = array(
    'style' => 'architect',
    'page_set' => 'thought_leadership',
    'mode' => 'configure',
    'config_status' => 'not_started',
  );

  $style = foleo_v1_sanitize_choice(
    isset($_POST['foleo_style']) ? wp_unslash($_POST['foleo_style']) : '',
    $options['style'],
    $defaults['style']
  );
  $page_set = foleo_v1_sanitize_choice(
    isset($_POST['foleo_page_set']) ? wp_unslash($_POST['foleo_page_set']) : '',
    $options['page_set'],
    $defaults['page_set']
  );
  $mode = foleo_v1_sanitize_choice(
    isset($_POST['foleo_mode']) ? wp_unslash($_POST['foleo_mode']) : '',
    $options['mode'],
    $defaults['mode']
  );
  $config_status = foleo_v1_sanitize_choice(
    isset($_POST['foleo_config_status']) ? wp_unslash($_POST['foleo_config_status']) : '',
    $options['config_status'],
    $defaults['config_status']
  );
  $template_id = isset($_POST['foleo_template_id']) ? sanitize_key(wp_unslash($_POST['foleo_template_id'])) : '';
  if (!isset($template_registry[$template_id])) {
    $template_id = foleo_v1_default_template_id_from_page_set($page_set);
  }

  $existing_mode = foleo_v1_sanitize_choice(get_post_meta($post->ID, 'foleo_mode', true), $options['mode'], $defaults['mode']);
  $existing_config_status = foleo_v1_sanitize_choice(get_post_meta($post->ID, 'foleo_config_status', true), $options['config_status'], $defaults['config_status']);
  $existing_seo_enabled = (get_post_meta($post->ID, 'foleo_seo_enabled', true) === '1' || get_post_meta($post->ID, 'foleo_public_seo_enabled', true) === '1') ? '1' : '0';
  $mode = isset($_POST['foleo_mode']) ? $mode : $existing_mode;
  $config_status = isset($_POST['foleo_config_status']) ? $config_status : $existing_config_status;
  if (isset($_POST['foleo_public_seo_enabled']) || isset($_POST['foleo_seo_enabled'])) {
    $seo_enabled = '1';
  } elseif (array_key_exists('foleo_public_seo_enabled', $_POST) || array_key_exists('foleo_seo_enabled', $_POST)) {
    $seo_enabled = '0';
  } else {
    $seo_enabled = $existing_seo_enabled;
  }
  if ($mode !== 'live' && isset($_POST['foleo_mode'])) {
    $seo_enabled = '0';
  }
  $existing_personalization_enabled = get_post_meta($post->ID, 'foleo_personalization_enabled', true) === '1' ? '1' : '0';
  $personalization_enabled = isset($_POST['foleo_personalization_enabled']) ? '1' : $existing_personalization_enabled;

  $draft_token = isset($_POST['foleo_draft_token']) ? sanitize_text_field(wp_unslash($_POST['foleo_draft_token'])) : '';
  if ($draft_token === '') {
    $existing = get_post_meta($post->ID, 'foleo_draft_token', true);
    $draft_token = is_string($existing) ? trim($existing) : '';
  }
  if ($draft_token === '') {
    $draft_token = foleo_v1_generate_draft_token();
  }

  $readiness = get_post_meta($post->ID, 'foleo_readiness_score', true);
  $readiness = is_numeric($readiness) ? (int) $readiness : 0;
  $workflow_type = isset($_POST['foleo_workflow_type']) ? sanitize_key(wp_unslash($_POST['foleo_workflow_type'])) : foleo_v1_get_workflow_type($post->ID);
  if (!in_array($workflow_type, array('standard', 'custom_build'), true)) {
    $workflow_type = 'standard';
  }
  $base_foleo_id = isset($_POST['foleo_base_foleo_id']) ? absint($_POST['foleo_base_foleo_id']) : absint(get_post_meta($post->ID, 'foleo_base_foleo_id', true));
  $base_foleo_kind = isset($_POST['foleo_base_foleo_kind']) ? sanitize_key(wp_unslash($_POST['foleo_base_foleo_kind'])) : sanitize_key((string) get_post_meta($post->ID, 'foleo_base_foleo_kind', true));
  if (!in_array($base_foleo_kind, array('library', 'yours'), true)) {
    $base_foleo_kind = $base_foleo_id ? 'yours' : '';
  }

  $foleo_name_input = isset($_POST['foleo_name']) ? sanitize_text_field(wp_unslash($_POST['foleo_name'])) : '';
  $foleo_name_input = trim($foleo_name_input);
  $foleo_name = $foleo_name_input;
  if ($foleo_name_input === '') {
    $foleo_name = get_the_title($post->ID);
  }
  if ($foleo_name !== '' && $foleo_name !== get_the_title($post->ID)) {
    wp_update_post(array(
      'ID' => $post->ID,
      'post_title' => $foleo_name,
    ));
  }

  $branding_exists = foleo_v1_workspace_branding_exists();
  $branding_mode = isset($_POST['foleo_branding_mode']) ? sanitize_key(wp_unslash($_POST['foleo_branding_mode'])) : sanitize_key((string) get_post_meta($post->ID, 'foleo_branding_mode', true));
  if (!in_array($branding_mode, array('inherit', 'custom'), true)) {
    $branding_mode = 'inherit';
  }

  $seo_visibility = isset($_POST['foleo_seo_visibility']) ? sanitize_key(wp_unslash($_POST['foleo_seo_visibility'])) : '';
  if (!in_array($seo_visibility, array('hidden', 'findable'), true)) {
    $seo_visibility = $existing_seo_enabled === '1' ? 'findable' : 'hidden';
  }
  $seo_enabled = $seo_visibility === 'findable' ? '1' : '0';

  $setup_errors = array();
  $setup_warnings = array();
  if ($is_continue && $foleo_name_input === '') {
    $setup_errors[] = 'name_required';
  }
  if (!$branding_exists) {
    $setup_warnings[] = 'branding_missing';
  }

  update_post_meta($post->ID, 'foleo_style', $style);
  update_post_meta($post->ID, 'foleo_page_set', $page_set);
  update_post_meta($post->ID, 'foleo_intent', $page_set);
  update_post_meta($post->ID, 'foleo_mode', $mode);
  update_post_meta($post->ID, 'foleo_config_status', $config_status);
  update_post_meta($post->ID, 'foleo_seo_enabled', $seo_enabled);
  update_post_meta($post->ID, 'foleo_public_seo_enabled', $seo_enabled);
  update_post_meta($post->ID, 'foleo_seo_visibility', $seo_enabled === '1' ? 'on' : 'off');
  update_post_meta($post->ID, 'foleo_personalization_enabled', $personalization_enabled);
  update_post_meta($post->ID, 'foleo_branding_mode', $branding_mode);
  update_post_meta($post->ID, 'foleo_workflow_type', $workflow_type);
  if ($base_foleo_id > 0) {
    update_post_meta($post->ID, 'foleo_base_foleo_id', $base_foleo_id);
  } else {
    delete_post_meta($post->ID, 'foleo_base_foleo_id');
  }
  if ($base_foleo_kind !== '') {
    update_post_meta($post->ID, 'foleo_base_foleo_kind', $base_foleo_kind);
  } else {
    delete_post_meta($post->ID, 'foleo_base_foleo_kind');
  }
  update_post_meta($post->ID, 'foleo_template_id', $template_id);
  update_post_meta($post->ID, 'foleo_draft_token', $draft_token);
  update_post_meta($post->ID, 'foleo_readiness_score', $readiness);
  foleo_v1_ensure_draft_meta_defaults($post->ID);

  if ($is_continue && empty($setup_errors)) {
    $continue_args = array(
      'page' => 'foleo-assets',
      'foleo_page_id' => $post->ID,
    );
    if (!empty($setup_warnings)) {
      $continue_args['setup_warning'] = implode(',', $setup_warnings);
    }
    $redirect(add_query_arg($continue_args, admin_url('admin.php')));
  }

  $status_args = array(
    'updated' => 1,
  );
  if (!empty($setup_errors)) {
    $status_args['setup_status'] = 'error';
    $status_args['setup_codes'] = implode(',', $setup_errors);
  } elseif (!empty($setup_warnings)) {
    $status_args['setup_status'] = 'warning';
    $status_args['setup_codes'] = implode(',', $setup_warnings);
  }

  $redirect(foleo_v1_review_doc_upload_url($post->ID, $status_args));
}, 20);

function foleo_render_workspace_shell() {
  if (!foleo_is_client_shell_context()) {
    wp_die('Forbidden', 403);
  }
  if (!current_user_can('read')) {
    wp_die('Forbidden', 403);
  }

  $items = get_posts(array(
    'post_type' => 'foleo_page',
    'post_status' => array('publish', 'draft', 'pending', 'future', 'private'),
    'posts_per_page' => 6,
    'orderby' => 'modified',
    'order' => 'DESC',
    'author' => get_current_user_id(),
    'meta_query' => array(
      'relation' => 'OR',
      array(
        'key' => 'foleo_is_library_item',
        'compare' => 'NOT EXISTS',
      ),
      array(
        'key' => 'foleo_is_library_item',
        'value' => '1',
        'compare' => '!=',
      ),
    ),
  ));

  echo '<div class="wrap foleo-admin-theme-scope">';
  echo '<h1>Workspace</h1>';
  echo '<div class="foleo-v1 foleo-v1--workspace">';
  echo '<section class="foleo-v1__drawer">';
  echo '<h2>Get started</h2>';
  echo '<div class="foleo-v1__cta-grid">';
  echo '<a class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--primary" href="' . esc_url(admin_url('admin.php?page=foleo-assets')) . '">Upload content</a>';
  echo '<a class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--primary" href="' . esc_url(admin_url('admin.php?page=foleo-v1-new')) . '">Create FOLEO</a>';
  echo '<a class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--secondary" href="mailto:support@foleo.co">Help</a>';
  echo '</div>';
  echo '</section>';
  echo '<section class="foleo-v1__drawer">';
  echo '<div class="foleo-v1__section-head"><h2>Recent FOLEOs</h2><a href="' . esc_url(admin_url('edit.php?post_type=foleo_page')) . '">Manage</a></div>';
  if (empty($items)) {
    echo '<p>No FOLEOs yet. Create a FOLEO to get started.</p>';
  } else {
    echo '<div class="foleo-v1__card-grid">';
    foreach ($items as $item) {
      $post_id = (int) $item->ID;
      $title = get_the_title($post_id);
      if ($title === '') {
        $title = 'Untitled';
      }
      $status = foleo_v1_workspace_status($post_id);
      $draft_token = trim((string) get_post_meta($post_id, 'foleo_draft_token', true));
      $draft_url = $draft_token !== '' ? foleo_v1_draft_url($draft_token) : '';
      $live_url = trim((string) get_post_meta($post_id, 'foleo_live_url', true));
      $public_seo_enabled = get_post_meta($post_id, 'foleo_public_seo_enabled', true) === '1' || get_post_meta($post_id, 'foleo_seo_enabled', true) === '1';
      if (!$public_seo_enabled || $live_url === '') {
        $live_url = '';
      }
      $copy_url = $live_url !== '' ? $live_url : $draft_url;

      echo '<article class="foleo-v1__card">';
      echo '<div class="foleo-v1__card-media" aria-hidden="true"></div>';
      echo '<h3>' . esc_html($title) . '</h3>';
      echo '<p class="description">' . esc_html($status) . '</p>';
      echo '<div class="foleo-v1__card-actions">';
      if ($draft_url !== '') {
        echo '<a class="button button-small foleo-ui-btn foleo-ui-btn--secondary" href="' . esc_url($draft_url) . '" target="_blank" rel="noopener noreferrer">Preview</a>';
      }
      echo '<a class="button button-small foleo-ui-btn foleo-ui-btn--primary" href="' . esc_url(foleo_v1_detail_url($post_id)) . '">Edit</a>';
      if ($live_url !== '') {
        echo '<a class="button button-small foleo-ui-btn foleo-ui-btn--secondary" href="' . esc_url($live_url) . '" target="_blank" rel="noopener noreferrer">View Live</a>';
      } elseif ($copy_url !== '') {
        echo '<button type="button" class="button button-small foleo-ui-btn foleo-ui-btn--secondary foleo-v1-copy-url" data-copy-url="' . esc_attr($copy_url) . '">Copy URL</button>';
      }
      echo '</div>';
      echo '</article>';
    }
    echo '</div>';
  }
  echo '</section>';
  echo '</div>';
  echo '</div>';
}

function foleo_v1_get_client_foleo_items($author_id = 0) {
  $args = array(
    'post_type' => 'foleo_page',
    'post_status' => array('publish', 'draft', 'pending', 'future', 'private'),
    'posts_per_page' => 250,
    'orderby' => 'modified',
    'order' => 'DESC',
    'meta_query' => array(
      'relation' => 'OR',
      array(
        'key' => 'foleo_is_library_item',
        'compare' => 'NOT EXISTS',
      ),
      array(
        'key' => 'foleo_is_library_item',
        'value' => '1',
        'compare' => '!=',
      ),
    ),
  );
  if ($author_id > 0) {
    $args['author'] = $author_id;
  }
  return get_posts($args);
}

function foleo_render_foleos_shell() {
  if (!foleo_is_client_shell_context()) {
    wp_die('Forbidden', 403);
  }
  if (!current_user_can('read')) {
    wp_die('Forbidden', 403);
  }

  $items = foleo_v1_get_client_foleo_items(get_current_user_id());
  $published = array();
  $draft = array();
  foreach ($items as $item) {
    $live_url = trim((string) get_post_meta($item->ID, 'foleo_live_url', true));
    $is_published = $item->post_status === 'publish' || $live_url !== '';
    if ($is_published) {
      $published[] = $item;
      continue;
    }
    $draft[] = $item;
  }

  echo '<div class="wrap foleo-admin-theme-scope">';
  echo '<div class="foleo-v1__section-head"><h1>FOLEOs</h1><a class="button button-primary" href="' . esc_url(admin_url('admin.php?page=foleo-v1-new')) . '">Add FOLEO</a></div>';
  echo '<div class="foleo-v1 foleo-v1--foleos"><main class="foleo-v1__main">';

  echo '<section class="foleo-v1__drawer">';
  echo '<h2>Published FOLEOs</h2>';
  foleo_render_foleos_rows($published, true);
  echo '</section>';

  echo '<section class="foleo-v1__drawer">';
  echo '<h2>Draft FOLEOs</h2>';
  foleo_render_foleos_rows($draft, false);
  echo '</section>';

  echo '</main></div>';
  echo '</div>';
}

function foleo_render_foleos_rows($items, $published) {
  if (empty($items)) {
    echo '<p>' . esc_html($published ? 'No published FOLEOs yet.' : 'No draft FOLEOs yet.') . '</p>';
    return;
  }

  echo '<div class="foleo-v1__rows">';
  foreach ($items as $item) {
    $post_id = (int) $item->ID;
    $title = get_the_title($post_id);
    if ($title === '') {
      $title = 'Untitled';
    }
    $draft_token = trim((string) get_post_meta($post_id, 'foleo_draft_token', true));
    $draft_url = $draft_token !== '' ? foleo_v1_draft_url($draft_token) : '';
    $live_url = trim((string) get_post_meta($post_id, 'foleo_live_url', true));
    $copy_url = $live_url !== '' ? $live_url : $draft_url;

    echo '<article class="foleo-v1__row">';
    echo '<div class="foleo-v1__row-main">';
    echo '<h3>' . esc_html($title) . '</h3>';
    echo '<p class="description">Intent: ' . esc_html(foleo_v1_intent_label(foleo_v1_get_intent($post_id))) . '</p>';
    echo '</div>';
    echo '<div class="foleo-v1__row-actions">';
    echo '<a class="button button-small" href="' . esc_url(foleo_v1_detail_url($post_id)) . '">' . esc_html($published ? 'Open' : 'Build') . '</a>';
    if ($draft_url !== '') {
      echo '<a class="button button-small" href="' . esc_url($draft_url) . '" target="_blank" rel="noopener noreferrer">Preview</a>';
    }
    if ($copy_url !== '') {
      echo '<button type="button" class="button button-small foleo-v1-copy-url" data-copy-url="' . esc_attr($copy_url) . '">Copy URL</button>';
    }
    echo '<form method="post" action="' . esc_url(admin_url('admin.php?page=foleo-v1-new')) . '" class="foleo-v1__action-form">';
    wp_nonce_field('foleo_v1_new_clone', 'foleo_v1_new_nonce');
    echo '<input type="hidden" name="foleo_v1_action" value="foleo_v1_clone_from_base" />';
    echo '<input type="hidden" name="foleo_base_foleo_id" value="' . esc_attr((string) $post_id) . '" />';
    echo '<button type="submit" class="button button-small">Duplicate</button>';
    echo '</form>';
    echo '<a class="button button-small" href="' . esc_url(get_delete_post_link($post_id, '', true)) . '">' . esc_html($published ? 'Archive' : 'Delete') . '</a>';
    echo '</div>';
    echo '</article>';
  }
  echo '</div>';
}

function foleo_render_assets_shell() {
  if (!foleo_is_client_shell_context()) {
    wp_die('Forbidden', 403);
  }
  if (!current_user_can('read')) {
    wp_die('Forbidden', 403);
  }

  echo '<div class="wrap foleo-admin-theme-scope">';
  echo '<h1>Assets</h1>';
  echo '<div class="foleo-v1 foleo-v1--assets"><main class="foleo-v1__main">';
  echo '<section class="foleo-v1__drawer"><h2>Images</h2><p>Upload and organize image files for your FOLEOs.</p><a class="button button-primary" href="' . esc_url(admin_url('upload.php')) . '">Open Images</a></section>';
  echo '<section class="foleo-v1__drawer"><h2>Documents</h2><p>Store source documents and Review Doc files.</p><a class="button button-primary" href="' . esc_url(admin_url('upload.php')) . '">Open Documents</a></section>';
  echo '<section class="foleo-v1__drawer"><h2>Videos</h2><p>Coming soon.</p></section>';
  echo '<section class="foleo-v1__drawer"><h2>Charts</h2><p>Coming soon.</p></section>';
  echo '</main></div>';
  echo '</div>';
}

function foleo_render_setup_shell() {
  if (!foleo_is_client_shell_context()) {
    wp_die('Forbidden', 403);
  }
  if (!current_user_can('read')) {
    wp_die('Forbidden', 403);
  }

  echo '<div class="wrap foleo-admin-theme-scope">';
  echo '<h1>Setup</h1>';
  echo '<div class="foleo-v1 foleo-v1--setup"><main class="foleo-v1__main">';
  echo '<section class="foleo-v1__drawer" id="foleo-brand"><h2>Brand</h2><p>Set logo, colors, and fonts for your FOLEOs.</p><p class="description">Brand controls are available in this section in v1.</p></section>';
  echo '</main></div>';
  echo '</div>';
}

function foleo_render_v1_new_shell() {
  if (!foleo_is_client_shell_context()) {
    wp_die('Forbidden', 403);
  }
  if (!current_user_can('edit_posts')) {
    wp_die('Forbidden', 403);
  }

  $style_filter = isset($_GET['style']) ? sanitize_key(wp_unslash($_GET['style'])) : 'all';
  if (!in_array($style_filter, array('all', 'consulting', 'architect'), true)) {
    $style_filter = 'all';
  }
  $style_query = array();
  if ($style_filter !== 'all') {
    $style_query[] = array(
      'key' => 'foleo_style',
      'value' => $style_filter,
      'compare' => '=',
    );
  }

  $your_meta_query = array(
    'relation' => 'AND',
    array(
      'relation' => 'OR',
      array(
        'key' => 'foleo_is_library_item',
        'compare' => 'NOT EXISTS',
      ),
      array(
        'key' => 'foleo_is_library_item',
        'value' => '1',
        'compare' => '!=',
      ),
    ),
  );
  foreach ($style_query as $clause) {
    $your_meta_query[] = $clause;
  }

  $your_foleos = get_posts(array(
    'post_type' => 'foleo_page',
    'post_status' => array('publish', 'draft', 'pending', 'future', 'private'),
    'posts_per_page' => 100,
    'orderby' => 'modified',
    'order' => 'DESC',
    'author' => get_current_user_id(),
    'meta_query' => $your_meta_query,
  ));

  $library_meta_query = array(
    array(
      'key' => 'foleo_is_library_item',
      'value' => '1',
      'compare' => '=',
    ),
  );
  foreach ($style_query as $clause) {
    $library_meta_query[] = $clause;
  }
  $library_foleos = get_posts(array(
    'post_type' => 'foleo_page',
    'post_status' => array('publish', 'draft', 'pending', 'future', 'private'),
    'posts_per_page' => 100,
    'orderby' => 'modified',
    'order' => 'DESC',
    'meta_query' => $library_meta_query,
  ));

  echo '<div class="wrap foleo-admin-theme-scope">';
  echo '<h1>Add a FOLEO</h1>';
  echo '<section class="foleo-v1__drawer foleo-ui-panel--feature foleo-v1__feature-panel">';
  echo '<h2>Build a FOLEO from scratch</h2>';
  echo '<p>Need something new, and do not have a starting design? Schedule a call and we will build a custom FOLEO for you.</p>';
  echo '<a class="button button-primary foleo-ui-btn foleo-ui-btn--primary" href="#" aria-disabled="true">Schedule a call</a>';
  echo '</section>';
  echo '<p class="foleo-v1__split-label">or</p>';

  echo '<div class="foleo-v1 foleo-v1--new">';
  echo '<main class="foleo-v1__main">';
  $template_items = array_merge($your_foleos, $library_foleos);
  if ($style_filter !== 'all') {
    $template_items = array_values(array_filter($template_items, function ($item) use ($style_filter) {
      $item_style = sanitize_key((string) get_post_meta($item->ID, 'foleo_style', true));
      return $item_style === $style_filter;
    }));
  }

  echo '<section class="foleo-v1__drawer foleo-v1__template-section">';
  echo '<div class="foleo-v1__template-head">';
  echo '<h2>Start with a template</h2>';
  echo '<div>';
  echo '<p>Choose a template to start with a proven layout and structure, then fill in your content.</p>';
  echo '<p>Want more options? Contact us to access the full template library, or build your own.</p>';
  echo '</div>';
  echo '</div>';
  if (!empty($template_items)) {
    echo '<div class="foleo-v1__picker-grid">';
    foreach ($template_items as $item) {
      $title = get_the_title($item);
      if ($title === '') {
        $title = 'Untitled';
      }
      $preview = foleo_v1_base_preview_url($item->ID);
      $style = sanitize_key((string) get_post_meta($item->ID, 'foleo_style', true));
      $intent = foleo_v1_get_intent($item->ID);
      echo '<article class="foleo-v1__card foleo-v1__picker-card">';
      echo '<div class="foleo-v1__card-media" aria-hidden="true"></div>';
      echo '<h3>' . esc_html($title) . '</h3>';
      echo '<div class="foleo-v1__template-meta">';
      echo '<p><strong>Business type:</strong> ' . esc_html(foleo_v1_style_label($style)) . '</p>';
      echo '<p><strong>Intent:</strong> ' . esc_html(foleo_v1_intent_label($intent)) . '</p>';
      echo '</div>';
      echo '<div class="foleo-v1__card-actions">';
      echo '<a class="button button-small foleo-ui-btn foleo-ui-btn--secondary" href="' . esc_url($preview) . '" target="_blank" rel="noopener noreferrer">Preview</a>';
      echo '<form method="post" action="' . esc_url(admin_url('admin.php?page=foleo-v1-new')) . '" class="foleo-v1__action-form">';
      wp_nonce_field('foleo_v1_new_clone', 'foleo_v1_new_nonce');
      echo '<input type="hidden" name="foleo_v1_action" value="foleo_v1_clone_from_base" />';
      echo '<input type="hidden" name="foleo_base_foleo_id" value="' . esc_attr((string) $item->ID) . '" />';
      echo '<input type="hidden" name="foleo_intent" value="' . esc_attr($intent) . '" />';
      echo '<button type="submit" class="button button-primary button-small foleo-ui-btn foleo-ui-btn--primary">Select</button>';
      echo '</form>';
      echo '</div>';
      echo '</article>';
    }
    echo '</div>';
  } else {
    echo '<p>No templates available.</p>';
  }
  echo '</section>';

  echo '</main>';
  echo '</div>';
  echo '</div>';
}

function foleo_render_v1_detail_shell() {
  if (!foleo_is_client_shell_context()) {
    wp_die('Forbidden', 403);
  }

  $post_id = isset($_GET['foleo_page_id']) ? absint($_GET['foleo_page_id']) : 0;
  $post = $post_id ? get_post($post_id) : null;
  if (!($post instanceof WP_Post) || $post->post_type !== 'foleo_page') {
    echo '<div class="wrap foleo-admin-theme-scope"><h1>FOLEO Detail</h1><p>Invalid FOLEO record.</p></div>';
    return;
  }
  if (!current_user_can('edit_post', $post->ID)) {
    wp_die('Forbidden', 403);
  }

  $options = foleo_v1_review_options();
  $defaults = array(
    'style' => 'architect',
    'page_set' => 'thought_leadership',
    'mode' => 'configure',
    'config_status' => 'not_started',
  );

  $style = foleo_v1_sanitize_choice(get_post_meta($post->ID, 'foleo_style', true), $options['style'], $defaults['style']);
  $page_set = foleo_v1_sanitize_choice(get_post_meta($post->ID, 'foleo_page_set', true), $options['page_set'], $defaults['page_set']);
  $intent = foleo_v1_sanitize_choice(foleo_v1_get_intent($post->ID), $options['page_set'], $defaults['page_set']);
  $mode = foleo_v1_sanitize_choice(get_post_meta($post->ID, 'foleo_mode', true), $options['mode'], $defaults['mode']);
  $config_status = foleo_v1_sanitize_choice(get_post_meta($post->ID, 'foleo_config_status', true), $options['config_status'], $defaults['config_status']);
  $template_registry = foleo_v1_template_registry();
  $template_id = foleo_v1_get_template_id($post->ID, $intent);
  $workflow_type = foleo_v1_get_workflow_type($post->ID);
  $base_foleo_id = absint(get_post_meta($post->ID, 'foleo_base_foleo_id', true));
  $base_foleo_kind = sanitize_key((string) get_post_meta($post->ID, 'foleo_base_foleo_kind', true));
  if (!in_array($base_foleo_kind, array('library', 'yours'), true)) {
    $base_foleo_kind = '';
  }
  $base_foleo = $base_foleo_id ? get_post($base_foleo_id) : null;
  $personalization_enabled = get_post_meta($post->ID, 'foleo_personalization_enabled', true) === '1' ? '1' : '0';
  $public_seo_enabled = (get_post_meta($post->ID, 'foleo_public_seo_enabled', true) === '1' || get_post_meta($post->ID, 'foleo_seo_enabled', true) === '1') ? '1' : '0';
  $seo_enabled = get_post_meta($post->ID, 'foleo_seo_enabled', true) === '1' ? '1' : '0';
  if ($mode !== 'live') {
    $seo_enabled = '0';
  }
  $draft_token = get_post_meta($post->ID, 'foleo_draft_token', true);
  $draft_token = is_string($draft_token) ? trim($draft_token) : '';
  $draft_url = $draft_token !== '' ? foleo_v1_draft_url($draft_token) : '';
  $live_url = trim((string) get_post_meta($post->ID, 'foleo_live_url', true));
  $readiness = get_post_meta($post->ID, 'foleo_readiness_score', true);
  $readiness = is_numeric($readiness) ? (int) $readiness : 0;
  $branding_exists = foleo_v1_workspace_branding_exists();
  $branding_mode = sanitize_key((string) get_post_meta($post->ID, 'foleo_branding_mode', true));
  if (!in_array($branding_mode, array('inherit', 'custom'), true)) {
    $branding_mode = 'inherit';
  }
  $has_seo_meta = metadata_exists('post', $post->ID, 'foleo_public_seo_enabled') || metadata_exists('post', $post->ID, 'foleo_seo_enabled');
  $seo_visibility_ui = ($has_seo_meta && $public_seo_enabled === '1') ? 'findable' : 'hidden';

  echo '<div class="wrap foleo-admin-theme-scope">';
  $setup_status = isset($_GET['setup_status']) ? sanitize_key((string) wp_unslash($_GET['setup_status'])) : '';
  $setup_codes_raw = isset($_GET['setup_codes']) ? sanitize_text_field((string) wp_unslash($_GET['setup_codes'])) : '';
  $setup_codes = $setup_codes_raw !== '' ? array_filter(array_map('trim', explode(',', $setup_codes_raw))) : array();
  $setup_messages = array();
  if (in_array($setup_status, array('warning', 'error'), true)) {
    foreach ($setup_codes as $code) {
      if ($code === 'name_required') {
        $setup_messages[] = 'FOLEO name is required to continue.';
      } elseif ($code === 'branding_missing') {
        $setup_messages[] = 'No workspace branding is configured. If you continue, this FOLEO will use the template\'s default styling.';
      }
    }
  }
  if (isset($_GET['updated']) && absint($_GET['updated']) === 1) {
    echo '<div class="notice notice-success is-dismissible"><p>Saved.</p></div>';
  }
  echo '<form method="post" class="foleo-v1__review-form foleo-v1__review-form--setup">';
  wp_nonce_field('foleo_v1_save_' . $post->ID, 'foleo_v1_nonce');
  echo '<input type="hidden" name="foleo_page_id" value="' . esc_attr($post->ID) . '" />';
  echo '<input type="hidden" name="foleo_v1_action" value="review_status_save" />';
  echo '<input type="hidden" name="foleo_workflow_type" value="' . esc_attr($workflow_type) . '" />';
  echo '<input type="hidden" name="foleo_base_foleo_id" value="' . esc_attr((string) $base_foleo_id) . '" />';
  echo '<input type="hidden" name="foleo_base_foleo_kind" value="' . esc_attr($base_foleo_kind) . '" />';
  echo '<input type="hidden" name="foleo_mode" value="' . esc_attr($mode) . '" />';
  echo '<input type="hidden" name="foleo_config_status" value="' . esc_attr($config_status) . '" />';
  echo '<input type="hidden" name="foleo_template_id" value="' . esc_attr($template_id) . '" />';
  echo '<input type="hidden" name="foleo_draft_token" value="' . esc_attr($draft_token) . '" />';

  echo '<div class="foleo-v1__setup-top">';
  echo '<label class="foleo-v1__setup-name">';
  echo '<span>Foleo Unique Name</span>';
  echo '<input type="text" name="foleo_name" value="' . esc_attr(get_the_title($post->ID)) . '" />';
  echo '</label>';
  echo '<div class="foleo-v1__setup-status-inline">';
  echo '<p><span>Status</span> ' . esc_html(foleo_v1_workspace_status($post->ID)) . '</p>';
  echo '<p><span>Draft URL</span> ' . ($draft_url !== '' ? '<a href="' . esc_url($draft_url) . '" target="_blank" rel="noopener noreferrer">' . esc_html($draft_url) . '</a>' : 'Not generated yet') . '</p>';
  echo '<p><span>Live URL</span> ' . ($live_url !== '' ? '<a href="' . esc_url($live_url) . '" target="_blank" rel="noopener noreferrer">' . esc_html($live_url) . '</a>' : 'Not published') . ' <span class="foleo-v1__status-sep">|</span> <span>Readiness Score</span> ' . esc_html((string) $readiness) . '</p>';
  echo '</div>';
  echo '</div>';
  echo '<div class="foleo-v1__setup-actions-row">';
  echo '<div class="foleo-v1__setup-actions foleo-v1__setup-actions--header">';
  echo '<button type="submit" name="foleo_submit_intent" value="save" class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--secondary">Save</button>';
  echo '<button type="submit" name="foleo_submit_intent" value="save_continue" class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--primary">Save &amp; Continue</button>';
  echo '</div>';
  echo '</div>';

  echo '<div class="foleo-v1 foleo-v1--detail">';
  echo '<aside class="foleo-v1__progress foleo-v1__progress--plain" aria-label="Build Progress">';
  echo '<ol class="foleo-v1__steps">';
  echo '<li class="is-active"><span>Setup</span></li>';
  echo '<li><span>Assets</span></li>';
  echo '<li><span>AI Pass</span></li>';
  echo '<li><span>Preview &amp; Approval</span></li>';
  echo '<li><span>Live</span></li>';
  echo '</ol>';
  echo '</aside>';

  if (!empty($setup_messages)) {
    echo '<div class="foleo-v1__setup-status foleo-v1__setup-status--' . esc_attr($setup_status) . '">';
    foreach ($setup_messages as $message) {
      echo '<p>' . esc_html($message) . '</p>';
    }
    echo '</div>';
  }

  echo '<main class="foleo-v1__main">';
  echo '<section class="foleo-v1__setup-panel">';
  echo '<section class="foleo-v1__setup-row">';
  echo '<h3>Branding</h3>';
  echo '<div class="foleo-v1__setup-row-copy">';
  echo '<p>This controls branding behavior for this FOLEO.</p>';
  if ($branding_exists) {
    echo '<p class="description">Choose whether to inherit your workspace branding or create unique branding for this FOLEO.</p>';
    echo '</div>';
    echo '<div class="foleo-v1__setup-row-actions">';
    echo '<label class="foleo-v1__field foleo-v1__field--toggle"><span>Inherit workspace branding</span><input type="radio" name="foleo_branding_mode" value="inherit"' . checked($branding_mode, 'inherit', false) . ' /></label>';
    echo '<label class="foleo-v1__field foleo-v1__field--toggle"><span>Create unique branding</span><input type="radio" name="foleo_branding_mode" value="custom"' . checked($branding_mode, 'custom', false) . ' /></label>';
    echo '<p><a href="' . esc_url(admin_url('admin.php?page=foleo-setup')) . '">Manage branding</a></p>';
  } else {
    echo '<p class="description">If you skip, this FOLEO will use the template\'s default styling.</p>';
    echo '</div>';
    echo '<div class="foleo-v1__setup-row-actions">';
    echo '<p><a class="button foleo-ui-btn foleo-ui-btn--secondary" href="' . esc_url(admin_url('admin.php?page=foleo-setup')) . '">Add branding</a></p>';
    echo '<label class="foleo-v1__field foleo-v1__field--toggle foleo-v1__field--toggle-inline"><input type="checkbox" name="foleo_use_default_branding" value="1" checked="checked" /><span>Use default branding</span></label>';
    echo '<input type="hidden" name="foleo_branding_mode" value="inherit" />';
  }
  echo '</div>';
  echo '</section>';
  echo '</section>';

  echo '<section class="foleo-v1__setup-panel">';
  echo '<section class="foleo-v1__setup-row">';
  echo '<h3>Selected Template</h3>';
  echo '<div class="foleo-v1__setup-row-copy">';
  echo '<p>This template provides your starting structure and defaults.</p>';
  echo '</div>';
  echo '<div class="foleo-v1__setup-row-actions">';
  if ($workflow_type === 'standard' && ($base_foleo instanceof WP_Post)) {
    $base_title = get_the_title($base_foleo->ID);
    if ($base_title === '') {
      $base_title = 'Untitled';
    }
    $base_style = sanitize_key((string) get_post_meta($base_foleo->ID, 'foleo_style', true));
    $base_intent = foleo_v1_get_intent($base_foleo->ID);
    echo '<div class="foleo-v1__template-meta">';
    echo '<p><strong>Name:</strong> ' . esc_html($base_title) . '</p>';
    echo '<p><strong>Business type:</strong> ' . esc_html(foleo_v1_style_label($base_style)) . '</p>';
    echo '<p><strong>Intent:</strong> ' . esc_html(foleo_v1_intent_label($base_intent)) . '</p>';
    echo '</div>';
    echo '<p><a class="button foleo-ui-btn foleo-ui-btn--utility" href="' . esc_url(admin_url('admin.php?page=foleo-v1-new')) . '">Select another template</a></p>';
  } else {
    echo '<p class="description">No template selected.</p>';
    echo '<p><a class="button foleo-ui-btn foleo-ui-btn--utility" href="' . esc_url(admin_url('admin.php?page=foleo-v1-new')) . '">Select another template</a></p>';
  }
  echo '</div>';
  echo '</section>';
  echo '</section>';

  echo '<section class="foleo-v1__setup-panel">';
  echo '<h3>Properties</h3>';
  echo '<div class="foleo-v1__setup-properties">';
  echo '<label class="foleo-v1__field"><span>Business Type</span><select name="foleo_style">';
  foreach ($options['style'] as $value => $label) {
    echo '<option value="' . esc_attr($value) . '" ' . selected($style, $value, false) . '>' . esc_html($label) . '</option>';
  }
  echo '</select></label>';
  echo '<label class="foleo-v1__field"><span>Intent</span><select name="foleo_page_set">';
  foreach ($options['page_set'] as $value => $label) {
    echo '<option value="' . esc_attr($value) . '" ' . selected($intent, $value, false) . '>' . esc_html($label) . '</option>';
  }
  echo '</select></label>';
  echo '<label class="foleo-v1__field"><span>SEO Visibility</span><select name="foleo_seo_visibility">';
  echo '<option value="hidden"' . selected($seo_visibility_ui, 'hidden', false) . '>Hidden from search engines</option>';
  echo '<option value="findable"' . selected($seo_visibility_ui, 'findable', false) . '>Search engines can find</option>';
  echo '</select></label>';
  echo '</div>';
  echo '</section>';

  echo '<div class="foleo-v1__setup-actions foleo-v1__setup-actions--bottom">';
  echo '<button type="submit" name="foleo_submit_intent" value="save" class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--secondary">Save</button>';
  echo '<button type="submit" name="foleo_submit_intent" value="save_continue" class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--primary">Save &amp; Continue</button>';
  echo '</div>';
  echo '</section>';
  echo '</main>';
  echo '</div>';
  echo '</form>';
  echo '</div>';
}

add_action('admin_enqueue_scripts', function ($hook_suffix) {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  $is_v1_list = false;
  if ($hook_suffix === 'edit.php' && function_exists('get_current_screen')) {
    $screen = get_current_screen();
    $is_v1_list = $screen && $screen->base === 'edit' && $screen->post_type === 'foleo_page';
  }

  $is_v1_detail = $hook_suffix === 'dashboard_page_foleo-v1-detail';
  $is_v1_new = $hook_suffix === 'dashboard_page_foleo-v1-new';
  $is_workspace = $hook_suffix === 'admin_page_foleo-workspace' || $hook_suffix === 'dashboard_page_foleo-workspace';
  $is_assets = $hook_suffix === 'dashboard_page_foleo-assets';
  $is_setup = $hook_suffix === 'dashboard_page_foleo-setup';
  if (!$is_v1_list && !$is_v1_detail && !$is_v1_new && !$is_workspace && !$is_assets && !$is_setup) {
    return;
  }

  wp_enqueue_style(
    'foleo-v1',
    foleo_core_asset_url('assets/css/foleo-v1.css'),
    array('foleo-admin-client', 'foleo-admin-client-wp-adapter'),
    FOLEO_CORE_VERSION
  );

  wp_enqueue_script(
    'foleo-v1',
    foleo_core_asset_url('assets/js/foleo-v1.js'),
    array(),
    FOLEO_CORE_VERSION,
    true
  );
}, 20);
