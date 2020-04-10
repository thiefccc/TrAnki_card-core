<?php

namespace App\Tests\v1\Functional\Controller\Card;

use App\Tests\Shared\ApiTestCase;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

/**
 * @coversDefaultClass \App\Controller\v1\Card\CardTypeController
 */
class CardTypeControllerTest extends ApiTestCase
{
    protected function setUp (): void
    {
        parent::setUp();
    }

    /**
     * @covers ::createCardType
     */
    public function testCreateCardType(): void
    {
        $cardTypeName = 'testName';
        $data = ['name' => $cardTypeName];

        $response = $this->client->request('POST', '/v1/card-type', ['json' => $data]);

        $createdCardType = json_decode($response->getContent(true), true);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals(
            ['/v1/card-type/' . $createdCardType['id']],
            $response->getHeaders()['location']
        );
        $this->assertArrayHasKey('name', $createdCardType);
        $this->assertEquals($cardTypeName, $createdCardType['name']);
    }

//    public function testGetCardTypeById(): void
//    {
//
//    }
}