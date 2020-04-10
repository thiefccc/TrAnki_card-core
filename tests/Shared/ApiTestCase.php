<?php

namespace App\Tests\Shared;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Component\HttpClient\HttpClient;

class ApiTestCase extends KernelTestCase
{
    protected static $staticClient;

    protected $client;

    public static function setUpBeforeClass()
    {
        self::bootKernel();

        self::$staticClient = HttpClient::createForBaseUri(
            getenv('API_TEST_BASE_URI')
        );

//        self::$staticClient = new Client([
//            'base_uri' => getenv('API_TEST_BASE_URI'),
//            'defaults' => [
//                'exceptions' => false
//            ]
//        ]);
    }

    protected function setUp()
    {
        $this->client = self::$staticClient;
        $this->purgeDatabase();
    }

    protected function getService($id)
    {
        return self::$kernel->getContainer()->get($id);
    }

    protected function tearDown(): void
    {
    }

    private function purgeDatabase(): void
    {
        $purger = new ORMPurger($this->getService('doctrine')->getManager());
        $purger->purge();
    }
}