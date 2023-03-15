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

class Notice extends AbstractNotice
{
    const HTML_CLASSES = [
        self::UPDATE_NAG => 'update-nag',
        self::ERROR => 'notice notice-error',
        self::WARNING => 'notice notice-warning',
        self::INFO => 'notice notice-info',
        self::SUCCESS => 'notice notice-success',
    ];

    /**
     * Echo notice to screen.
     *
     * @param string $action Unused.
     *
     * @return void
     */
    public function render(string $action)
    {
        printf(
            '<div id="%1$s" class="%2$s">%3$s</div>',
            esc_attr($this->getHandle()),
            esc_attr($this->htmlClass),
            wp_kses_post($this->content)
        );
    }
}
