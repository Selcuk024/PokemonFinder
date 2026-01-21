<?php

/**
 * Plugin Name: Pokemon Finder
 * Plugin URI:
 * Description: Find your favorite Pokemon easily.
 * Version:     1.0
 * Author:      Selcuk Dogan
 * Author URI:  selcuk024.github.io
 */


include_once plugin_dir_path(__FILE__) . 'api-connection.php';
include_once plugin_dir_path(__FILE__) . 'short-code.php';
include_once plugin_dir_path(__FILE__) . 'settings.php';

add_action('wp_head', function () {
    ?>
    <style>
        .pokemon-finder-form input[type="text"] {
            padding: 6px 8px;
            font-size: 14px;
            border-radius: 3px;
            border: solid 1px;
        }

        .pokemon-finder-form .button {
            padding: 6px 12px;
            cursor: pointer;
            background-color: black;
            color: white;
            border: solid black 1px;
            transition-duration: 0.2s;
            border-radius: 3px;

        }
        .pokemon-finder-form .button:hover{
            background-color: white;
            color: black;

        }
        .pokemon-finder-name{
            font-weight: 600;
        }
        .pokemon-finder-image{
            margin-left: auto !important;
        }
    </style>
    <?php
});