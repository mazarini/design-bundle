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
use Symfony\Component\HttpFoundation\Response;

class ControllerTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testUrl(string $url, int $status = Response::HTTP_OK, string $redirect = null): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);
        $this->assertSame($client->getResponse()->getStatusCode(), $status);
        if (null !== $redirect) {
            $this->assertResponseRedirects($redirect);
        }
    }

    public function urlProvider(): \Generator
    {
        yield ['', Response::HTTP_SEE_OTHER, '/design/'];
        yield ['/', Response::HTTP_SEE_OTHER, '/design/'];
        yield ['/design', Response::HTTP_MOVED_PERMANENTLY, 'http://localhost/design/'];
        yield ['/design/', Response::HTTP_OK];
    }
}
