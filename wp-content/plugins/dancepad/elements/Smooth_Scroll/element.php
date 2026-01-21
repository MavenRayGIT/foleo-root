<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


if(get_option('dan_smooth_scroll_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\SmoothScroll",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class SmoothScroll extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" d="M15.0549 1.24999H12.9451H12.9451C11.5775 1.24998 10.4752 1.24996 9.60825 1.36652C8.70814 1.48754 7.95027 1.74643 7.34835 2.34835C6.74643 2.95026 6.48754 3.70814 6.36652 4.60825C6.24996 5.47521 6.24998 6.57752 6.25 7.9451V7.94512V22.75H19C20.5188 22.75 21.75 21.5188 21.75 20V7.94513V7.94512C21.75 6.57753 21.75 5.47521 21.6335 4.60825C21.5125 3.70814 21.2536 2.95026 20.6517 2.34835C20.0497 1.74643 19.2919 1.48754 18.3918 1.36652C17.5248 1.24996 16.4225 1.24998 15.0549 1.24999H15.0549Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M11 5.25781C10.5858 5.25781 10.25 5.59359 10.25 6.00781C10.25 6.42202 10.5858 6.75781 11 6.75781H17C17.4142 6.75781 17.75 6.42202 17.75 6.00781C17.75 5.59359 17.4142 5.25781 17 5.25781H11ZM11 9.24999C10.5858 9.24999 10.25 9.58578 10.25 9.99999C10.25 10.4142 10.5858 10.75 11 10.75H17C17.4142 10.75 17.75 10.4142 17.75 9.99999C17.75 9.58578 17.4142 9.24999 17 9.24999H11ZM10.25 14C10.25 13.5858 10.5858 13.25 11 13.25H14C14.4142 13.25 14.75 13.5858 14.75 14C14.75 14.4142 14.4142 14.75 14 14.75H11C10.5858 14.75 10.25 14.4142 10.25 14ZM16.1972 17.2933C15.8744 17.2499 15.4776 17.2499 15.0448 17.25H4.95525C4.52244 17.2499 4.12561 17.2499 3.8028 17.2933C3.44732 17.3411 3.07159 17.4535 2.76257 17.7626C2.45354 18.0716 2.3411 18.4473 2.2933 18.8028C2.2499 19.1256 2.24995 19.5672 2.25 20C2.25 21.5188 3.48122 22.75 5 22.75H19C18.3096 22.75 17.75 22.1904 17.75 21.5C17.7501 21.0672 17.7501 19.1256 17.7067 18.8028C17.6589 18.4473 17.5465 18.0716 17.2374 17.7626C16.9284 17.4535 16.5527 17.3411 16.1972 17.2933Z" fill="currentColor" />
</svg>';
    }

    static function tag()
    {
        return 'div';
    }

    static function tagOptions()
    {
        return ['section', 'footer', 'header', 'nav', 'aside', 'article', 'main'];
    }

    static function tagControlPath()
    {
        return false;
    }

    static function name()
    {
        return 'Smooth Scroll';
    }

    static function className()
    {
        return 'dan-smooth-scroll';
    }

    static function category()
    {
        return 'dancepad_cores';
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
        return ['content' => ['settings' => ['type' => 'lenisjs', 'smooth' => 1.8, 'smooth_touch' => false], 'lenis' => ['content_at' => 'body', 'wheel_multiplier' => 2]]];
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
        "settings",
        "Settings",
        [c(
        "type",
        "Type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'lenisjs', 'text' => 'Lenis'], ['text' => 'ScrollSmoother', 'value' => 'scrollsmoother']]],
        false,
        false,
        [],
      ), c(
        "disable_at_the_builder",
        "Disable at the builder",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "disable_at_touch_devices",
        "Disable at touch devices",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "smooth",
        "Smooth",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "smooth_touch",
        "Smooth touch",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.settings.disable_at_touch_devices', 'operand' => 'is not set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "touch_multiplier",
        "Touch multiplier",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'step' => 0.1], 'condition' => [[['path' => 'content.settings.disable_at_touch_devices', 'operand' => 'is not set', 'value' => ''], ['path' => 'content.settings.smooth_touch', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "lenis",
        "Lenis",
        [c(
        "content_at",
        "Content at",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "wheel_multiplier",
        "Wheel multiplier",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "infinite_scroll",
        "Infinite scroll",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "scroll_snap",
        "Scroll snap",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "snap_type",
        "Snap type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'mandatory', 'text' => 'mandatory'], ['text' => 'proximity', 'value' => 'proximity']], 'condition' => [[['path' => 'content.lenis.scroll_snap', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "proximity_limit",
        "Proximity limit",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['%']], 'condition' => [[['path' => 'content.lenis.scroll_snap', 'operand' => 'is set', 'value' => ''], ['path' => 'content.lenis.snap_type', 'operand' => 'equals', 'value' => 'proximity']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.settings.type', 'operand' => 'equals', 'value' => 'lenisjs']]]],
        false,
        false,
        [],
      ), c(
        "scrollsmoother",
        "ScrollSmoother",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<ul><li><p>Put all your content inside your "Content at" element. This element has to be a children of the body.<br> If you are using fixed position elements (e.g: back to top) then you have to put them outside your "Content at" element.</p></li></ul>']],
        false,
        false,
        [],
      ), c(
        "content_at",
        "Content at",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
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
        "note_items",
        "Note items",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Use the following to create parallax items using GSAP ScrollSmoother.</p><p>Speed 0.5 would scroll at half the normal speed and Speed 2 would scroll at twice the normal speed.</p><p>Lag 0.8 would take 0.8 seconds to "catch up".</p><p>To create parallax effects at images, put the image inside a smaller block that has "overflow: hidden" and set the image class Speed to "auto"</p>']],
        false,
        false,
        [],
      ), c(
        "parallax_items",
        "Parallax Items",
        [c(
        "element_class",
        "Element class",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'placeholder' => 'className'],
        false,
        false,
        [],
      ), c(
        "speed",
        "Speed",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "lag",
        "Lag",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.settings.type', 'operand' => 'equals', 'value' => 'scrollsmoother']]]],
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
                'title' => 'Dancepad - Lenis',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_lenis.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' =>  [
                'title' => 'Dancepad - GSAP ScrollSmoother',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_gsap_scroll_smoother.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '2' =>  [
                'title' => 'Dancepad - Smooth Scroll',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Smooth_Scroll/dancepad_smooth_scroll.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '3' =>  [
                'title' => 'GSAP',
                'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%','%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],
            ],
            '4' =>  [
                'title' => 'Init Builder',
                'inlineScripts' => [
                    'dancepad_smooth_scroll();'
                ],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '5' =>  [
                'title' => 'Init Front',
                'inlineScripts' => [
                    'dancepad_smooth_scroll();'
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

'onPropertyChange' => [['script' => 'dancepad_smooth_scroll();',
],],

'onCreatedElement' => [['script' => 'dancepad_smooth_scroll();',
],],

'onMountedElement' => [['script' => 'dancepad_smooth_scroll();',
],],

'onMovedElement' => [['script' => 'dancepad_smooth_scroll();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_smooth_scroll();',
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
        return [['name' => 'data-type', 'template' => '{{ content.settings.type }}'], ['name' => 'data-duration', 'template' => '{{ content.settings.smooth }}'], ['name' => 'data-disable-builder', 'template' => '{% if content.settings.disable_at_the_builder %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-disable-screen', 'template' => '{% if content.settings.disable_at_touch_devices %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-smoothtouch', 'template' => '{% if content.settings.smooth_touch %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-touchmultiplier', 'template' => '{{ content.settings.touch_multiplier }}'], ['name' => 'data-touchsmooth', 'template' => '{% if content.settings.smooth_touch %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-wrapper', 'template' => '{{ content.lenis.content_at }}'], ['name' => 'data-wrapperGSAP', 'template' => '{{ content.scrollsmoother.content_at }}'], ['name' => 'data-ease', 'template' => '{{ content.scrollsmoother.gsap_easing }}'], ['name' => 'data-wheelmultiplier', 'template' => '{{ content.lenis.wheel_multiplier }}'], ['name' => 'data-infinite', 'template' => '{% if content.lenis.infinite_scroll %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-enable-snap', 'template' => '{% if content.lenis.scroll_snap %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-type-snap', 'template' => '{{ content.lenis.snap_type }}'], ['name' => 'data-proximity-limit-snap', 'template' => '{{ content.lenis.proximity_limit.style }}'], ['name' => 'data-classes', 'template' => '{% for item in content.scrollsmoother.parallax_items %}{{ item.element_class }}next11{% endfor %}'], ['name' => 'data-speeds', 'template' => '{% for item in content.scrollsmoother.parallax_items %}{{ item.speed }}next11{% endfor %}'], ['name' => 'data-lags', 'template' => '{% for item in content.scrollsmoother.parallax_items %}{{ item.lag }}next11{% endfor %}']];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
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
        return ['content.content.text'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }

    static function availableIn()
    {
      return ['breakdance', 'oxygen'];
    }
}

}
