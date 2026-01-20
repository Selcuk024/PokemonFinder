<?php


function pokemonFinder_shortcode() {
    $output = '';

    $output .= '
        <form method="get">
            <input type="text" name="pokemon" placeholder="Pokemon naam of ID">
            <button type="submit">Zoeken</button>
        </form>
    ';

    if ( isset($_GET['pokemon']) && $_GET['pokemon'] !== '' ) {
        $pokemon_name = sanitize_text_field($_GET['pokemon']);
        $pokemon = pokemonFinder_api_request($pokemon_name);

        if ( $pokemon ) {
            $output .= '<h3>' . esc_html( ucfirst($pokemon->name) ) . '</h3>';
            $output .= '<img src="' . esc_url($pokemon->sprites->front_default) . '" alt="">';
            $output .= '<p>ID: ' . esc_html($pokemon->id) . '</p>';
        } else {
            $output .= '<p>Pokemon niet gevonden.</p>';
        }
    }

    return $output;
}
add_shortcode('pokemon_finder', 'pokemonFinder_shortcode');
