<?php

/**
 * This file is part of mazarini/design-bundle.
 *
 * mazarini/design-bundle is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * mazarini/design-bundle is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with mazarini/design-bundle. If not, see <https://www.gnu.org/licenses/>.
 *
 * @package mazarini/design-bundle
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlTest extends WebTestCase
{
    /**
     * @dataProvider okProvider
     */
    public function testUrlOk(string $url): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);
        $this->assertResponseIsSuccessful();
    }

    /**
     * @dataProvider redirectProvider
     */
    public function testUrlRedirect(string $url): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);
        $this->assertResponseRedirects();
    }

    public function redirectProvider(): \Generator
    {
        yield [''];
        yield ['/'];
        yield ['/design'];
    }

    public function okProvider(): \Generator
    {
        yield ['/design/'];
    }
}
