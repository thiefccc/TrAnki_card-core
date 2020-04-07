<?php

namespace App\Tests\v1\Service;

use App\Entity\CardType;
use App\Repository\CardTypeRepository;
use App\Service\v1\CardTypeService;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \App\Service\v1\CardTypeService
 */
class CardTypeServiceTest extends TestCase
{
    private $cardTypeRepository;
    private $cardTypeService;

    protected function setUp()
    {
        $this->cardTypeRepository =
            $this->createMock(CardTypeRepository::class);

        $this->cardTypeService = new CardTypeService($this->cardTypeRepository);
    }

    public function dataSirializeCardType()
    {
        return [
            'serialize simple card type' => [
                'id' => 1,
                'name' => 'text',
                'expected' => [
                    'id' => 1,
                    'name' => 'text',
                ]
            ],
        ];
    }

    /**
     * @dataProvider dataSirializeCardType
     * @covers ::serializeCardType
     */
    public function testSirializeCardType(
        $cardId,
        $cardName,
        $expectedSerializedCard
    ) {
        $cardType = new CardType();
        $this->set($cardType, $cardId);
        $cardType->setName($cardName);

        $this->assertSame(
            $expectedSerializedCard,
            $this->cardTypeService->serializeCardType($cardType)
        );
    }

    public function set($entity, $value, $propertyName = 'id')
    {
        $class = new ReflectionClass($entity);
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);

        $property->setValue($entity, $value);
    }
}