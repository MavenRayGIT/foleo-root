<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


if(get_option('dan_cursor_enable') == 'true') {
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Cursor",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Cursor extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" d="M22.4713 12.3883C22.5985 12.5548 22.7521 12.8161 22.75 13.145C22.7449 13.9292 22.2098 14.461 21.7032 14.7923C21.182 15.1332 20.5147 15.3837 19.8703 15.5759C19.2158 15.771 18.5301 15.9216 17.9464 16.0425C17.5407 16.1252 16.8195 16.2727 16.6145 16.3302C16.2748 16.4256 16.2181 16.4843 16.2064 16.4969C16.1912 16.5133 16.1333 16.5838 16.0537 16.9461L16.0497 16.9642C15.6761 18.6634 15.3813 20.004 15.0655 20.919C14.9076 21.3764 14.7229 21.7948 14.4781 22.1126C14.2191 22.4487 13.8464 22.7267 13.3427 22.749C13.0066 22.7639 12.7387 22.6105 12.573 22.4874C12.3957 22.3557 12.2359 22.1846 12.0945 22.0079C11.8097 21.6522 11.5168 21.1684 11.2306 20.6214C10.6541 19.5197 10.0468 18.0491 9.53409 16.5407C9.0217 15.0331 8.59252 13.4546 8.38505 12.1364C8.28171 11.4797 8.22869 10.859 8.25806 10.3312C8.28531 9.84136 8.39016 9.26609 8.75986 8.86796C9.14133 8.45716 9.71816 8.32127 10.211 8.27376C10.7394 8.22283 11.3621 8.25729 12.0199 8.34357C13.3408 8.51682 14.9282 8.9164 16.4468 9.40522C17.9668 9.89449 19.4527 10.4844 20.5704 11.0526C21.1255 11.3347 21.6173 11.6252 21.981 11.9102C22.1619 12.0519 22.3361 12.2115 22.4713 12.3883Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5167 3.30807C11.5688 3.14922 10.5408 3.16615 9.60387 3.35424C9.07593 3.46022 8.56204 3.11816 8.45606 2.59022C8.35007 2.06229 8.69214 1.54839 9.22007 1.44241C10.3898 1.20759 11.657 1.18684 12.839 1.38491C13.37 1.4739 13.7284 1.97656 13.6394 2.50763C13.5504 3.03869 13.0477 3.39706 12.5167 3.30807ZM14.6723 2.86872C14.9334 2.39778 15.5268 2.22765 15.9977 2.48873C16.9858 3.03649 17.8701 3.74739 18.6147 4.58488C18.9725 4.9873 18.9363 5.60357 18.5339 5.96135C18.1315 6.31914 17.5152 6.28295 17.1574 5.88053C16.558 5.20626 15.8463 4.63437 15.0523 4.19417C14.5813 3.93309 14.4112 3.33966 14.6723 2.86872ZM7.01712 3.18951C7.31663 3.637 7.19666 4.24256 6.74916 4.54206C5.87414 5.12771 5.121 5.88178 4.53644 6.75761C4.23751 7.20548 3.6321 7.32623 3.18423 7.0273C2.73636 6.72837 2.61561 6.12296 2.91454 5.67509C3.64118 4.5864 4.57688 3.64953 5.66457 2.92155C6.11206 2.62205 6.71762 2.74202 7.01712 3.18951ZM19.0849 6.83603C19.5818 6.62861 20.1528 6.8633 20.3602 7.36021C20.4928 7.67783 20.6094 8.00382 20.709 8.33717C20.8631 8.85311 20.5698 9.39631 20.0538 9.55044C19.5379 9.70457 18.9947 9.41126 18.8406 8.89532C18.7607 8.62786 18.6671 8.36627 18.5607 8.11135C18.3533 7.61443 18.588 7.04345 19.0849 6.83603ZM2.58572 8.4704C3.11383 8.57551 3.45674 9.08883 3.35164 9.61695C3.16441 10.5577 3.14981 11.5895 3.31185 12.5397C3.40237 13.0705 3.04545 13.5741 2.51464 13.6647C1.98383 13.7552 1.48015 13.3983 1.38963 12.8675C1.18757 11.6826 1.20544 10.4107 1.43917 9.23632C1.54428 8.70821 2.0576 8.36529 2.58572 8.4704ZM2.86823 14.6716C3.33922 14.4106 3.93261 14.5809 4.19362 15.0518C4.62731 15.8344 5.1889 16.537 5.85035 17.1311C6.25096 17.4909 6.28404 18.1073 5.92423 18.508C5.56442 18.9086 4.94797 18.9416 4.54737 18.5818C3.72581 17.8439 3.0277 16.9708 2.48804 15.997C2.22703 15.5261 2.39725 14.9327 2.86823 14.6716ZM6.84705 19.0916C7.05377 18.5944 7.62442 18.3589 8.12163 18.5656C8.3727 18.67 8.63022 18.7619 8.89343 18.8406C9.40933 18.9949 9.70251 19.5382 9.54826 20.0541C9.39401 20.57 8.85074 20.8631 8.33483 20.7089C8.00678 20.6108 7.68585 20.4962 7.37303 20.3662C6.87582 20.1595 6.64033 19.5888 6.84705 19.0916Z" fill="currentColor" />
</svg>';
    }

    static function tag()
    {
        return 'div';
    }

    static function tagOptions()
    {
        return [];
    }

    static function tagControlPath()
    {
        return "content.content.tag";
    }

    static function name()
    {
        return 'Cursor';
    }

    static function className()
    {
        return 'dan-cursor';
    }

    static function category()
    {
        return 'dancepad_cursors';
    }

    static function badge()
    {
        return ['backgroundColor' => 'var(--gray500)', 'textColor' => 'var(--white)', 'label' => 'DP'];
    }

    static function slug()
    {
        return __CLASS__;
    }

    static function template()
    {
        return file_get_contents(__DIR__ . '/html.twig');
    }

    static function defaultCss()
    {
        return file_get_contents(__DIR__ . '/default.css');
    }

    static function defaultProperties()
    {
        return ['content' => ['default' => ['css_cursor' => 'default', 'color' => '#000', 'size' => 'scale(0.2)', 'active_size' => 'scale(0.5)', 'skew' => 0, 'zindex' => 99999, 'visible_by_default' => true, 'hide_on_leave' => true, 'speed' => 0.55, 'border_radius' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'gsap_easing' => 'expo']]];
    }

    static function defaultChildren()
    {
        return false;
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [];
    }

    static function contentControls()
    {
        return [c(
        "default",
        "Default",
        [c(
        "disable_at_the_builder",
        "Disable at the builder",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "css_cursor",
        "CSS Cursor",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'auto', 'text' => 'auto'], ['text' => 'default', 'value' => 'default'], ['text' => 'none', 'value' => 'none'], ['text' => 'pointer', 'value' => 'pointer'], ['text' => 'context-menu', 'value' => 'context-menu'], ['text' => 'help', 'value' => 'help'], ['text' => 'progress', 'value' => 'progress'], ['text' => 'wait', 'value' => 'wait'], ['text' => 'cell', 'value' => 'cell'], ['text' => 'crosshair', 'value' => 'crosshair'], ['text' => 'text', 'value' => 'text'], ['text' => 'vertical-text', 'value' => 'vertical-text'], ['text' => 'alias', 'value' => 'alias'], ['text' => 'copy', 'value' => 'copy'], ['text' => 'move', 'value' => 'move'], ['text' => 'no-drop', 'value' => 'no-drop'], ['text' => 'not-allowed', 'value' => 'not-allowed'], ['text' => 'grab', 'value' => 'grab'], ['text' => 'grabbing', 'value' => 'grabbing'], ['text' => 'zoom-in', 'value' => 'zoom-in'], ['text' => 'zoom-out', 'value' => 'zoom-out'], ['text' => 'col-resize', 'value' => 'col-resize'], ['text' => 'row-resize', 'value' => 'row-resize'], ['text' => 'n-resize', 'value' => 'n-resize'], ['text' => 'e-resize', 'value' => 'e-resize'], ['text' => 's-resize', 'value' => 's-resize'], ['text' => 'w-resize', 'value' => 'w-resize'], ['text' => 'ne-resize', 'value' => 'ne-resize'], ['text' => 'nw-resize', 'value' => 'nw-resize'], ['text' => 'se-resize', 'value' => 'se-resize'], ['text' => 'sw-resize', 'value' => 'sw-resize'], ['text' => 'ew-resize', 'value' => 'ew-resize'], ['text' => 'ns-resize', 'value' => 'ns-resize'], ['text' => 'nesw-resize', 'value' => 'nesw-resize'], ['text' => 'nwse-resize', 'value' => 'nwse-resize'], ['text' => 'all-scroll', 'value' => 'all-scroll']]],
        false,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "size",
        "Size",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "active_size",
        "Active size",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "skew",
        "Skew",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "visible_by_default",
        "Visible by default",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border radius",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        false,
        false,
        [],
      ), c(
        "speed",
        "Speed",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hide_on_leave",
        "Hide on leave",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "gsap_easing",
        "GSAP easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>The following sections are states to apply to the cursor when the mouse is over an element.<br>Assign a class to the element you want to target. Then put the class at the state you want to apply to that element.</p>']],
        false,
        false,
        [],
      ), c(
        "magnetics",
        "Magnetics",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      ), c(
        "speed",
        "Speed",
        [],
        ['type' => 'text', 'layout' => 'inline', 'placeholder' => '1'],
        false,
        false,
        [],
      ), c(
        "intensity",
        "Intensity",
        [],
        ['type' => 'text', 'layout' => 'inline', 'placeholder' => '1'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "repels",
        "Repels",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      ), c(
        "speed",
        "Speed",
        [],
        ['type' => 'text', 'layout' => 'inline', 'placeholder' => '1'],
        false,
        false,
        [],
      ), c(
        "intensity",
        "Intensity",
        [],
        ['type' => 'text', 'layout' => 'inline', 'placeholder' => '1'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "hiddens",
        "Hiddens",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "exclusions",
        "Exclusions",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "backdrops",
        "Backdrops",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      ), c(
        "backdrop",
        "Backdrop",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px']]],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "blurs",
        "Blurs",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      ), c(
        "blur",
        "Blur",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px']]],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "skews",
        "Skews",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      ), c(
        "skew",
        "Skew",
        [],
        ['type' => 'text', 'layout' => 'inline', 'placeholder' => '0'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "colors",
        "Colors",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "sizes",
        "Sizes",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      ), c(
        "size",
        "Size",
        [],
        ['type' => 'text', 'layout' => 'inline', 'placeholder' => 'scale(0.2)'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), c(
        "texts",
        "Texts",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      ), c(
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "medias",
        "Medias",
        [c(
        "class",
        "Class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      ), c(
        "url",
        "URL",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "stick_delta",
        "Stick delta",
        [],
        ['type' => 'text', 'layout' => 'inline', 'placeholder' => '0.15'],
        false,
        false,
        [],
      ), c(
        "sticks",
        "Sticks",
        [c(
        "from_class",
        "From class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      ), c(
        "to_class",
        "To class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'placeholder' => 'className or tag'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      )];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return [
            '0' =>  [
                'title' => 'Dancepad - Mouse Follower library',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_mouse_follower.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' =>  [
                'title' => 'Dancepad - Cursor',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Cursor/dancepad_cursor.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '2' =>  [
                'title' => 'Init Builder',
                'inlineScripts' => [
                    'dancepad_cursor();'
                ],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '3' =>  [
                'title' => 'GSAP',
                'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%'],
            ],
            '4' =>  [
                'title' => 'Init Front',
                'inlineScripts' => [
                    'dancepad_cursor();'
                ],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
        ];
    }

    static function settings()
    {
        return ['disableAI' => false];
    }

    static function addPanelRules()
    {
        return false;
    }

    static public function actions()
    {
        return [

'onPropertyChange' => [['script' => 'dancepad_cursor();',
],],

'onCreatedElement' => [['script' => 'dancepad_cursor();',
],],

'onMountedElement' => [['script' => 'dancepad_cursor();',
],],

'onMovedElement' => [['script' => 'dancepad_cursor();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_cursor();',
],],];
    }

    static function nestingRule()
    {
        return ["type" => "final",   ];
    }

    static function spacingBars()
    {
        return false;
    }

    static function attributes()
    {
        return [['name' => 'data-defaultcursor', 'template' => '{{ content.default.css_cursor }}'], ['name' => 'data-defaultcolor', 'template' => '{{ content.default.color }}'], ['name' => 'data-defaultsize', 'template' => '{{ content.default.size }}'], ['name' => 'data-defaultactive', 'template' => '{{ content.default.active_size }}'], ['name' => 'data-defaultskew', 'template' => '{{ content.default.skew }}'], ['name' => 'data-defaultzindex', 'template' => '{{ content.default.zindex }}'], ['name' => 'data-defaultvisible', 'template' => '{% if content.default.visible_by_default %}
true
{% else %}
false
{% endif %}'], ['name' => 'data-defaulthide', 'template' => '{% if content.default.hide_on_leave %}
true
{% else %}
false
{% endif %}'], ['name' => 'data-defaultspeed', 'template' => '{{ content.default.speed }}'], ['name' => 'data-border-top-radius', 'template' => '{{ content.default.border_radius.style }}'], ['name' => 'data-border-bottom-radius', 'template' => '{{ content.default.border_radius.style }}'], ['name' => 'data-border-left-radius', 'template' => '{{ content.default.border_radius.style }}'], ['name' => 'data-border-right-radius', 'template' => '{{ content.default.border_radius.style }}'], ['name' => 'data-defaultease', 'template' => '{{ content.default.gsap_easing }}'], ['name' => 'data-disableAtBuilder', 'template' => '{% if content.default.disable_at_the_builder %}
true
{% else %}
false
{% endif %}']];
    }

    static function experimental()
    {
        return false;
    }

    static function order()
    {
        return 0;
    }

    static function dynamicPropertyPaths()
    {
        return [['accepts' => 'string', 'path' => 'content.animation.distance']];
    }

    static function additionalClasses()
    {
        return false;
    }

    static function projectManagement()
    {
        return false;
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return false;
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}

}
