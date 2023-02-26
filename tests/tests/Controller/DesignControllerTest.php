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

use Mazarini\DesignBundle\Util\Folder;
use Mazarini\DesignBundle\Util\Template;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DesignControllerTest extends WebTestCase
{
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testDesignController(): void
    {
        $root = \dirname(__DIR__, 2).'/templates';
        $theme = $root.'/theme';
        $this->testFolder(new Folder($root, $theme));
    }

    private function testFolder(Folder $folder): void
    {
        foreach ($folder as $item) {
            if ($item instanceof Folder) {
                $this->testFolder($item);
            }
            if ($item instanceof Template) {
                $url = '/design/'.$item->getTemplate();
                $crawler = $this->client->request('GET', $url);
                $this->assertResponseIsSuccessful();
                $this->assertCount(
                    1,
                    $crawler->filter('div#menuDesignModal'),
                    sprintf('The page "%s" has no menu', $url)
                );
            }
        }
    }
}
