<?php
/**
 * WP Admin Notices
 *
 * A simplified OOP implementation of the WordPress admin notices.
 *
 * @package   TypistTech\WPAdminNotices
 *
 * @author    Typist Tech <wp-admin-notices@typist.tech>
 * @copyright 2017 Typist Tech
 * @license   GPL-2.0+
 *
 * @see       https://www.typist.tech/projects/wp-admin-notices
 * @see       https://github.com/TypistTech/wp-admin-notices
 *
 * Modified by __root__ on 13-March-2023 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace PGMB\Vendor\TypistTech\WPAdminNotices;

class StickyNotice extends AbstractNotice
{
    const IS_STICKY = true;

    const HTML_CLASSES = [
        self::ERROR => 'is-dismissible notice notice-error',
        self::WARNING => 'is-dismissible notice notice-warning',
        self::INFO => 'is-dismissible notice notice-info',
        self::SUCCESS => 'is-dismissible notice notice-success',
    ];

    /**
     * Echo notice to screen.
     *
     * @param string $action AJAX request's 'action' property for sticky notices.
     *
     * @return void
     */
    public function render(string $action)
    {
        printf(
            '<div id="%1$s" data-handle="%1$s" data-action="%2$s" class="%3$s">%4$s</div>',
            esc_attr($this->getHandle()),
            esc_attr($action),
            esc_attr($this->htmlClass),
            wp_kses_post($this->content)
        );
    }
}
