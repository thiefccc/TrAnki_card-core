<?php

namespace App\Tests\v1\Functional\Controller\Card;

use App\Tests\Shared\ApiTestCase;
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
     * TODO dataProvider
     * @covers ::createCardType
     */
    public function testCreateCardType(): void
    {
        $cardTypeName = 'testName';
        $data = [
            'name' => $cardTypeName
        ];

        $response = $this->client->post(
            '/v1/card-type',
            ['body' => json_encode($data)]
        );

        $createdCardType = json_decode($response->getBody(true), true);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals(
            ['/v1/card-type/' . $createdCardType['id']],
            $response->getHeader('Location')
        );
    }

    public function testGetCardTypeById(): void
    {

    }
}