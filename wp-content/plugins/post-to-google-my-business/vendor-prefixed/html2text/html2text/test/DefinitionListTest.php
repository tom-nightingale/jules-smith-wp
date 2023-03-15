<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by __root__ on 13-March-2023 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace PGMB\Vendor\Html2Text;

class DefinitionListTest extends \PHPUnit_Framework_TestCase
{
    public function testDefinitionList()
    {
        $html =<<< EOT
<dl>
  <dt>Definition Term:</dt>
  <dd>Definition Description<dd>
</dl>
EOT;
        $expected =<<<EOT
 	* Definition Term: Definition Description 


EOT;

        $html2text = new Html2Text($html);
        $output = $html2text->getText();

        $this->assertEquals($expected, $output);
    }
}
