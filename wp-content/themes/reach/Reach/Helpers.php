<?php

namespace Reach;

class Helpers
{
    public static function startsWith($haystack, $needle): bool
    {
        $length = strlen($needle);
        return substr($haystack, 0, $length) === $needle;
    }

    /**
     * Builds an HTML string from an array of attribute key-value pairs.
     *
     * Valid attribute value types are: scalars (int, float, string, and bool) and arrays.
     * An empty string is considered a valid value; equivalent to a `true` boolean.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes#boolean_attributes
     *
     * @param array $attributes An array of attribute key-value pairs.
     * @return string A HTML string containing space-separated, escaped HTML element attributes.
     */
    public static function buildAttributes(array $attributes = []): string
    {
        if (empty($attributes)) {
            return '';
        }

        $html = array_map(
            function ($key, $val) {
                if (!isset($val) || (!is_scalar($val) && !is_array($val))) {
                    return ''; // invalid value type.
                } elseif (is_bool($val)) {
                    return $val ? \esc_html($key) : '';
                } elseif (is_array($val)) {
                   // $val = array_unique($val);

                    if (empty($val)) {
                        return '';
                    }

                    if ($key === 'style') {
                        // Build CSS declarations for 'style' attribute.
                        $val = array_reduce(
                            array_keys($val),
                            function ($carry, $k) use ($val) {
                                if (!is_numeric($k)) {
                                    $carry[] = "$k: $val[$k];";
                                }
                                return $carry;
                            },
                            []
                        );
                    } else {
                        $val = array_filter($val, function ($i) {
                            return !empty($i) || is_numeric($i);
                        });
                    }

                    $val = implode(' ', $val);
                }

                $key = \esc_html($key);
                $val = self::isUrlAttribute($key) ? \esc_url(trim($val)) : \esc_attr(trim($val));

                return "$key=\"$val\"";
            },
            array_keys($attributes),
            $attributes
        );

        return implode(' ', $html);
    }

    /**
     * Determines whether the given attribute must contain a "valid" URL string.
     *
     * Excludes the itemid, itemprop, and ping attributes, as they may not always contain a URL, or
     * may contain a space-separated list of URLs.
     *
     * @link https://url.spec.whatwg.org/#valid-url-string
     * @link https://html.spec.whatwg.org/multipage/indices.html#attributes-3
     *
     * @param string $attribute The attribute name.
     * @return boolean Whether the attribute must contain a URL.
     */
    public static function isUrlAttribute(string $attribute): bool
    {
        return !empty($attribute) && in_array($attribute, [
            // Attributes that must contain URL strings.
            'action',
            'cite', // https://developer.mozilla.org/en-US/docs/Web/HTML/Element/blockquote#attr-cite
            'data', // https://developer.mozilla.org/en-US/docs/Web/HTML/Element/object#attr-data
            'formaction',
            'href',
            'poster',
            'src',
        ], true);
    }

    /**
     * Builds an HTML classes string.
     *
     * @param array $classes An array of class strings.
     * @return string An escaped string of classes.
     */
    public static function buildClasses(array $classes = []): string
    {
        $classesString = '';

        if (empty($classes)) {
            return $classesString;
        }

        $classesString = implode(' ', array_unique($classes));

        return \esc_attr(trim($classesString));
    }

    /**
     * Prints a formatted error to the log. Optionally echoes it.
     *
     * @param $message An error (array, object, string)
     * @param $echo Whether to echo the error (if WP_DEBUG_DISPLAY is true)
     * @return void
     */
    public static function errorLog($message, $echo = false): void
    {
        if (!defined('WP_DEBUG') || WP_DEBUG !== true) {
            return;
        }

        if (is_array($message) || is_object($message)) {
            error_log(var_export($message, true));
        } else {
            error_log($message);
        }

        // Bail - no need to continue
        if (empty($echo)) {
            return;
        }

        if (defined('WP_DEBUG_DISPLAY') && WP_DEBUG_DISPLAY === true) {
            self::debug($message);
        }
    }

    /**
     * Echoes a message in a formatted <pre> container.
     *
     * @param $message A message to print
     * @param $die Whether to die() after printing the message
     * @return void
     */
    public static function debug($message, $die = false): void
    {
        if (!defined('WP_DEBUG') || WP_DEBUG !== true) {
            return;
        }

        if (!defined('WP_DEBUG_DISPLAY') || WP_DEBUG_DISPLAY !== true) {
            return;
        }

        ini_set("highlight.default", "#222;");
        ini_set("highlight.html", "#808080");
        ini_set("highlight.keyword", "#912d72; font-weight: bold;");
        ini_set("highlight.string", "#112468;");
        ini_set("highlight.comment", "#222");

        echo "
            <pre style='
                font-size: 14px;
                padding: 1em;
                color: #222;
                background: #eee;
                border-radius: 9px;
                overflow-wrap: break-word;
            '>
        ";
        highlight_string("<?php\n" . var_export($message, true) . ";\n?>");
        echo "</pre>";

        if ($die) {
            die();
        }
    }

    /**
     * Determines whether a given object is an instance of a given set of classes.
     *
     * @param object $object The object to check.
     * @param array $classNames An array of class names to validate against. Default empty array.
     */
    public static function isValidClass($object, $classNames = []): bool
    {
        foreach ($classNames as $className) {
            if (is_a($object, $className)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determines whether the query is for any existing taxonomy archive page.
     *
     * Combines WordPress's `is_tax()`, `is_category()`, and `is_tag()` functions.
     *
     * @param string|string[] $taxonomy Taxonomy slug or slugs to check against.
     * @param int|string|int[]|string[] $term Term ID, name, slug, or array of such to check against.
     * @return boolean Whether the query is for an existing taxonomy archive page (custom or built-in).
     */
    public static function isTaxonomy($taxonomy = '', $term = ''): bool
    {
        if ($taxonomy === 'category') {
            return \is_category($term);
        } elseif ($taxonomy === 'post_tag') {
            return \is_tag($term);
        } elseif (!empty($taxonomy)) {
            return \is_tax($taxonomy, $term);
        }

        return \is_tax($taxonomy, $term) || \is_category($term) || \is_tag($term);
    }
}
