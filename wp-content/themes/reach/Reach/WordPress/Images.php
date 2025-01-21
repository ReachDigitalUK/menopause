<?php

namespace Reach\WordPress;

class Images
{
    public static function init(): void
    {
        \add_action('after_setup_theme', [__CLASS__, 'registerImageSizes']);
        \add_filter('image_size_names_choose', [__CLASS__, 'setThemeImageSizeNames']);
        \add_filter('intermediate_image_sizes_advanced', [__CLASS__, 'removeUnwantedImageSizes']);
        \add_filter('jpeg_quality', [__CLASS__, 'setDefaultJPEGQuality']);
        \add_filter('big_image_size_threshold', [__CLASS__, 'setMaxImageSize']);
    }

    public static function registerImageSizes(): void
    {
        \add_theme_support('post-thumbnails');
        \set_post_thumbnail_size(150, 150, true);

        $reach_sizes = \apply_filters('reach/config/image_sizes', []);
        if (!empty($reach_sizes)) {
            foreach ($reach_sizes as $size_id => $size_info) {
                if ($size_info === false) {
                    continue;
                }

                if (empty($size_info[2])) {
                    $size_info[2] = false;
                }

                \add_image_size(
                    $size_id,
                    $size_info[0],
                    $size_info[1],
                    $size_info[2]
                );
            }
        }
    }

    /**
     * Set the nice names for each image.
     *
     * @link https://developer.wordpress.org/reference/hooks/image_size_names_choose/
     */
    public static function setThemeImageSizeNames(array $sizes): array
    {
        $reach_sizes = \apply_filters('reach/config/image_sizes', []);
        if (!empty($reach_sizes)) {
            foreach ($reach_sizes as $size_id => $size) {
                if ($size === false) {
                    continue;
                }

                $sizes[$size_id] = ucwords(str_replace('_', ' ', str_replace('reach_', '', $size_id)));
            }
        }

        return $sizes;
    }

    /**
     * Prevent images for unwanted default sizes being generated on upload.
     *
     * @link https://developer.wordpress.org/reference/hooks/intermediate_image_sizes_advanced/
     */
    public static function removeUnwantedImageSizes(array $sizes): array
    {
        $reach_sizes = \apply_filters('reach/config/image_sizes', []);
        if (!empty($reach_sizes)) {
            foreach ($sizes as $size_id => $size) {
                if (array_key_exists($size_id, $reach_sizes) && $reach_sizes[$size_id] === false) {
                    unset($sizes[$size_id]);
                }
            }
        }

        return $sizes;
    }

    /**
     * Set the default JPEG compression quality on upload.
     *
     * @link https://developer.wordpress.org/reference/hooks/jpeg_quality/
     */
    public static function setDefaultJPEGQuality(int $quality): int
    {
        return \apply_filters('reach/config/jpeg_upload_quality', $quality);
    }

    /**
     * Set the threshold (in pixels) at which images will be downscaled.
     *
     * @link https://developer.wordpress.org/reference/hooks/big_image_size_threshold/
     */
    public static function setMaxImageSize(int $threshold): int
    {
        return \apply_filters('reach/config/max_image_size', $threshold);
    }
}
