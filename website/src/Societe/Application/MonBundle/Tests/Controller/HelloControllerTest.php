<?php
/**
 * Created by PhpStorm.
 * User: llevague
 * Date: 19/03/15
 * Time: 09:38
 */

namespace Societe\Application\MonBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloControllerTest extends WebTestCase{

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'monbundle/hello/Fabien');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Hello Fabien")')->count());
    }
}