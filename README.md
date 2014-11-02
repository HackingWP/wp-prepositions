WordPress Prepositions
======================

*A typography beautifier.*

---

Tiny filter to fix hanging short prepositions at the end of the lines. 

## Installation

1. Download zip and upload to your `wp-content/plugins` or install via `wp-admin` Plugins interface;
1. Activate

## Docs

You can easily override defaults in which to apply typographycal fixes without editing plugin just by using [WordPress add_filter()](http://codex.wordpress.org/Function_Reference/add_filter).

Example:

```
`add_filter('fixTypographyPrepositionsIn', function($array) {
  $array[] = 'my_custom_filter_hook';

  return $array; // DO NOT forget to return
});
```

---

Enjoy!

[@martin_adamko](http://twitter.com/martin_adamko)
