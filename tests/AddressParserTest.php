<?php
/**
 * User: Carp Cai
 * Date: 2018/11/30
 * Time: 6:39 PM
 */
namespace CarpCai\AddressParser\Tests;

use CarpCai\AddressParser\Parser;
use PHPUnit\Framework\TestCase;


class AddressParserTest extends TestCase
{
//    public function setUp(){}
//    public function tearDown(){}
    /**
     * 测试是否能解析美国的地址
     * CarpCai <2018/12/1 12:40 PM>
     */
    public function testRightUSAddressParse()
    {
        $addressesArray = [
            ['555 Test Drive, Testville, CA 98773-1111', ['555 Test Drive', 'Testville', 'CA', '98773', '', '1111']],
            ['555 Test Drive, Testville, CA 98773', ['555 Test Drive', 'Testville', 'CA', '98773', '', '']],
            ['555 Test Drive, Testville, California 98773', ['555 Test Drive', 'Testville', 'CA', '98773', '', '']],
            ['555 Test Drive,Testville,CA 98773', ['555 Test Drive', 'Testville', 'CA', '98773', '', '']],
            ['555 Test Drive,Testville,CA98773', ['555 Test Drive', 'Testville', 'CA', '98773', '', '']],
            ['555 Test Drive,Testville,CA98773', ['555 Test Drive', 'Testville', 'CA', '98773', '', '']],
            ['555 Test Drive,Testville,CA', ['555 Test Drive', 'Testville', 'CA', '', '', '']],
            ['Carp Cai 555 Test Drive,Testville,CA', ['555 Test Drive', 'Testville', 'CA', '', 'Carp Cai', '', '']],
        ];

        foreach ($addressesArray as $addresses) {
            $addressRes = Parser::newParse($addresses[0]);

            $this->assertEquals( $addresses[1][0],  $addressRes->addressLine1);
            $this->assertEquals( $addresses[1][1],  $addressRes->city);
            $this->assertEquals( $addresses[1][2],  $addressRes->state);
            $this->assertEquals( $addresses[1][3],  $addressRes->zipcode);
            $this->assertEquals( $addresses[1][4],  $addressRes->name);
            $this->assertEquals( $addresses[1][5],  $addressRes->plus4);
        }
    }


    public function testWrongUSAddressParse()
    {
        $address = Parser::newParse('Test Drive, Testville, CA 98773');

        $this->assertEquals( -1,  $address->error_code);
    }
}
