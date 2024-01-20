<?php
/**
 * Nexmo Client Library for PHP
 *
 * @copyright Copyright (c) 2016 Nexmo, Inc. (http://nexmo.com)
 * @license   https://github.com/Nexmo/nexmo-php/blob/master/LICENSE.txt MIT License
 */

namespace NexmoTest\Account;

use Nexmo\Network;
use Nexmo\Account\PrefixPrice;
use PHPUnit\Framework\TestCase;

class PrefixPriceTest extends TestCase
{
    public function setUp()
    {
    }

    /**
     * @dataProvider prefixPriceProvider
     */
    public function testFromArray($prefixPrice)
    {
        $this->assertEquals("ZW", $prefixPrice->getCountryCode());
        $this->assertEquals("Zimbabwe", $prefixPrice->getCountryName());
        $this->assertEquals("263", $prefixPrice->getDialingPrefix());
    }

    /**
     * @dataProvider prefixPriceProvider
     */
    public function testGetters($prefixPrice)
    {
        $this->assertEquals("ZW", $prefixPrice->getCountryCode());
        $this->assertEquals("Zimbabwe", $prefixPrice->getCountryName());
        $this->assertEquals("Zimbabwe", $prefixPrice->getCountryDisplayName());
        $this->assertEquals("263", $prefixPrice->getDialingPrefix());
    }

    /**
     * @dataProvider prefixPriceProvider
     */
    public function testArrayAccess($prefixPrice)
    {
        $this->assertEquals("ZW", $prefixPrice['country_code']);
        $this->assertEquals("Zimbabwe", $prefixPrice['country_name']);
        $this->assertEquals("Zimbabwe", $prefixPrice['country_display_name']);
        $this->assertEquals("263", $prefixPrice['dialing_prefix']);
    }

    /**
     * @dataProvider prefixPriceProvider
     */
    public function testUsesCustomPriceForKnownNetwork($prefixPrice)
    {
        $this->assertEquals("0.123", $prefixPrice->getPriceForNetwork('21039'));
    }

    public function prefixPriceProvider()
    {
        $r = [];

        $prefixPrice = new PrefixPrice();
        $prefixPrice->jsonUnserialize([
            'country' => 'ZW',
            'name' => 'Zimbabwe',
            'prefix' => 263,
            'networks' => [
                [
                    'code' => '21039',
                    'network' => 'Demo Network',
                    'mtPrice' => '0.123'
                ]
            ]
        ]);
        $r['jsonUnserialize'] = [$prefixPrice];

        return $r;
    }
}

