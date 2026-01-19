<?php

function pokemonFinder_api_request( $name_or_id ) {
    $url = 'https://pokeapi.co/api/v2/pokemon/' . strtolower( $name_or_id );

    $response = wp_remote_get( $url );


    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body );

    return $data;
}
