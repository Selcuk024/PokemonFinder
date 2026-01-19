<?php
require_once __DIR__ . '/PokemonFinder.php';

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

