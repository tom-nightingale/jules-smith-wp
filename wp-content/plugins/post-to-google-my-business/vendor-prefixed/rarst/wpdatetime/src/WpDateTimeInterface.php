<?php
/**
 * @license MIT
 *
 * Modified by __root__ on 13-March-2023 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace PGMB\Vendor\Rarst\WordPress\DateTime;

/**
 * @see WpDateTimeTrait
 */
interface WpDateTimeInterface extends \DateTimeInterface {

	public static function createFromPost( $post, $field = 'date' );

	public function formatI18n( $format );

	public function formatDate();

	public function formatTime();
}
