<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by __root__ on 13-March-2023 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace PGMB\Vendor\Html2Text;

class PrintTest extends \PHPUnit_Framework_TestCase
{
	const TEST_HTML = 'Hello, &quot;<b>world</b>&quot;';
	const EXPECTED = 'Hello, "WORLD"';

	public function setUp() {
        $this->html = new Html2Text(self::TEST_HTML);
        $this->expectOutputString(self::EXPECTED);		
	}

    public function testP()
    {
        $this->html->p();
    }

    public function testPrint_text()
    {
        $this->html->print_text();
    }
}
