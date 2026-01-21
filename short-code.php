<?php

include_once plugin_dir_path(__FILE__) . 'settings.php';

function pokemonFinder_shortcode()
{

    $output = '';

    $output .= '
    <form method="get" class="pokemon-finder-form">
        <input type="text" name="pokemon" placeholder="Pokemon naam">
        <button type="submit" class="button">Zoeken</button>
    </form>
    ';

    if (isset($_GET['pokemon']) && $_GET['pokemon'] !== '') {
        $pokemon_name = sanitize_text_field($_GET['pokemon']);
        $pokemon = pokemonFinder_api_request($pokemon_name);
        $settings = pokemonfinder_get_settings();

        if ($pokemon) {
            if ($settings['show_name']) {
                $output .= '<h1 class="pokemon-finder-name">' . esc_html(ucfirst($pokemon->name)) . '</h1>';
            }

            if ($settings['show_photo']) {
                $output .= '<img class="pokemon-finder-image" src="' . esc_url($pokemon->sprites->front_default) . '" alt="">';
            }

            if ($settings['show_id']) {
                $output .= '<p>ID: ' . esc_html($pokemon->id) . '</p>';
            }
        } else {
            $output .= '<p>Pokemon niet gevonden.</p>';
        }
    }

    return $output;
}
add_shortcode('pokemon_finder', 'pokemonFinder_shortcode');