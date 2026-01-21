<?php
require_once __DIR__ . '/pokemon-finder.php';

function pokemonfinder_add_menu() {
    add_menu_page(
        'Pokemon Finder Settings',
        'Pokemon Finder Settings',
        'manage_options',
        'pokemonfinder-settings',
        'pokemonfinder_page_content',
        plugin_dir_url(__FILE__) . 'assets/icon.svg',

    );
}

add_action('admin_menu', 'pokemonfinder_add_menu');



function pokemonfinder_register_settings() {
    register_setting(
        'pokemonfinder_settings_group',
        'pokemonfinder_settings',
        'pokemonfinder_sanitize_settings'
    );

    add_settings_section(
        'pokemonfinder_main_section',
        'instellingen',
        function () {
            echo '<p>Kies welke informatie je wilt tonen.</p>';
        },
        'pokemonfinder-settings'
    );

    add_settings_field(
        'show_name',
        'Naam tonen',
        'pokemonfinder_field_show_name',
        'pokemonfinder-settings',
        'pokemonfinder_main_section'
    );

    add_settings_field(
        'show_photo',
        'Foto tonen',
        'pokemonfinder_field_show_photo',
        'pokemonfinder-settings',
        'pokemonfinder_main_section'
    );

    add_settings_field(
        'show_id',
        'ID tonen',
        'pokemonfinder_field_show_id',
        'pokemonfinder-settings',
        'pokemonfinder_main_section'
    );
}
add_action('admin_init', 'pokemonfinder_register_settings');

function pokemonfinder_sanitize_settings($input) {
    $output = array();

    $output['show_name']  = isset($input['show_name']) ? 1 : 0;
    $output['show_photo'] = isset($input['show_photo']) ? 1 : 0;
    $output['show_id']    = isset($input['show_id']) ? 1 : 0;

    return $output;
}

function pokemonfinder_get_settings() {
    $defaults = array(
        'show_name' => 1,
        'show_photo' => 1,
        'show_id' => 1,
    );

    $saved = get_option('pokemonfinder_settings', array());
    return wp_parse_args($saved, $defaults);
}

function pokemonfinder_field_show_name() {
    $field = pokemonfinder_get_settings();
    echo '<label><input type="checkbox" name="pokemonfinder_settings[show_name]" value="1" ' . checked(1, $field['show_name'], false) . '> Toon naam</label>';
}

function pokemonfinder_field_show_photo() {
    $field = pokemonfinder_get_settings();
    echo '<label><input type="checkbox" name="pokemonfinder_settings[show_photo]" value="1" ' . checked(1, $field['show_photo'], false) . '> Toon foto</label>';
}

function pokemonfinder_field_show_id() {
    $field = pokemonfinder_get_settings();
    echo '<label><input type="checkbox" name="pokemonfinder_settings[show_id]" value="1" ' . checked(1, $field['show_id'], false) . '> Toon ID</label>';
}

function pokemonfinder_page_content() {
    ?>
    <div class="wrap">
        <h1>Pokemon Finder Settings</h1>

        <form method="post" action="options.php">
            <?php
            settings_fields('pokemonfinder_settings_group');
            do_settings_sections('pokemonfinder-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}