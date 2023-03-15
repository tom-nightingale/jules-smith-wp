<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by __root__ on 13-March-2023 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace PGMB\Vendor\Html2Text;

class SpanTest extends \PHPUnit_Framework_TestCase
{

    public function testIgnoreSpans()
    {
    	$html =<<< EOT
Outside<span class="_html2text_ignore">Inside</span>
EOT;
        $expected =<<<EOT
Outside
EOT;

        $html2text = new Html2Text($html);
        $output = $html2text->getText();

        $this->assertEquals($expected, $output);
    }
}
