<?php

namespace Theme\WordPress;

class MimeTypes
{
    public static function init()
    {
        \add_filter('reach/wordpress/upload_mimes/types', [__CLASS__, 'addThemeMimeTypes']);
    }

    /**
     * Add extra allowed mime types to file uploads via the 'reach/wordpress/upload_mimes/types' filter.
     *
     * @see Reach/WordPress/UploadMimes.php
     *
     * @param array $types An array of allowed mime types.
     * @return array The filtered array of allowed mime types.
     */
    public static function addThemeMimeTypes(array $types): array
    {
        // Add extra mime types.
        $types = array_merge($types, [
            'svg' => 'image/svg+xml',
            // 'msg'  => 'application/vnd.ms-outlook',
            // 'flv'  => 'video/x-flv',
            // 'xls'  => 'application/application/excel',
            // 'xlsx' => 'application/application/vnd.ms-excel',
            // 'tiff' => 'image/tiff',
            // 'tif'  => 'image/tiff',
            // 'psd'  => 'image/photoshop',
            // 'xlsx' => 'application/application/vnd.ms-excel',
            // 'swf'  => 'application/x-shockwave-flash',
        ]);

        return $types;
    }
}
