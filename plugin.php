<?php
/**
 * Plugin Name: WP Prepositions
 * Plugin URI: https://github.com/HackingWP/wp-prepositions
 * Description: Tiny filter to fix hanging short prepositions at the end of the lines.
 * Version: v0.1.0
 * Author: Martin Adamko
 * Author URI: http://martinadamko.sk
 * License: MIT
 */

if (!function_exists('fixTypographyPrepositions')) {
/**
 * Fix small words on line ends
 *
 */
function fixTypographyPrepositions($text, $pass = 0)
{
    $nbsp = " ";          // Non-breaking space

    $regex = '/'.
        '([\s>'.$nbsp.'](?!\.))'. // begins with space, non-breaking space or end of a tag'>', captured as $1,
                          // not begining with a dot

        '('.              // start to capture $2
        '(?<![<])'.       // negative lookbehing
        '[\w\.'.$nbsp.']{1,2}'.   // not more than 2 word characters
        ')'.              // end capturing group $2

        '\s'.             // space between words

        '('.              // start to capture $3
        '[\w\.<]'.        // any word character or `.` or '<'
        ')'.              // end capturing group $3

    '/';

    $replace = "$1$2".$nbsp."$3";

    // 2 passes
    if ($pass < 1) {
        return preg_replace($regex, $replace, fixTypographyPrepositions($text, $pass + 1));
    }

    // final pass
    return preg_replace($regex, $replace, $text);
}
}

$fixTypographyPrepositionsIn = apply_filters('fixTypographyPrepositionsIn', array('the_title', 'the_content', 'comment_excerpt', 'the_excerpt', 'get_the_excerpt'));

// Hook important text to fix
foreach ($fixTypographyPrepositionsIn as $filter) {
    add_filter( $filter, 'fixTypographyPrepositions');
}
