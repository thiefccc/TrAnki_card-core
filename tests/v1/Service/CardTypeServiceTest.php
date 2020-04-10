<?php

namespace App\Tests\v1\Service;

use App\Entity\CardType;
use App\Repository\CardTypeRepository;
use App\Service\Shared\SlackClient;
use App\Service\v1\CardTypeService;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormInterface;

/**
 * @coversDefaultClass \App\Service\v1\CardTypeService
 */
class CardTypeServiceTest extends TestCase
{
    /**
     * @var CardTypeService
     */
    private $cardTypeService;
    /**
     * @var SerializerInterface|null
     */
    private $serializer;

    protected function getService($id)
    {
        return self::$kernel->getContainer()->get($id);
    }

    protected function setUp()
    {
        $this->serializer = $this->getMockBuilder(SerializerInterface::class)
            ->getMock();

        $this->cardTypeService = new CardTypeService($this->serializer);
    }

    public function dataSerializeCardType(): array
    {
        return [
            'serialize simple card type' => [
                'id' => 1,
                'name' => 'text',
            ],
        ];
    }

    /**
     * @dataProvider dataSerializeCardType
     * @covers ::serializeCardType
     */
    public function testSirializeCardType(
        $cardId,
        $cardName
    ) {
        $cardType = new CardType();
        $this->set($cardType, $cardId);
        $cardType->setName($cardName);

        $this->serializer
            ->expects($this->once())
            ->method('serialize');

        $this->cardTypeService->serializeCardType($cardType);
    }

    /**
     * @dataProvider dataSerializeCardType
     * @covers ::serializeCardTypes
     */
    public function testSirializeCardTypes(
        $cardId,
        $cardName
    ) {
//        $cardType = new CardType();
//        $this->set($cardType, $cardId);
//        $cardType->setName($cardName);
//
//        $cardTypes[] = $cardType;
//
//        $cardType = new CardType();
//        $this->set($cardType, $cardId + 1);
//        $cardType->setName($cardName);
//
//        $cardTypes[] = $cardType;

        $cardTypes[] = new CardType();
        $cardTypes[] = new CardType();

        $this->serializer
            ->expects($this->once())
            ->method('serialize');

        $this->cardTypeService->serializeCardTypes($cardTypes);
    }

    public function testProessForm()
    {
        $formMock = $this->getMockBuilder(FormInterface::class)
            ->getMock();

        $formMock->expects($this->once())->method('submit')->with(
            $this->identicalTo(
                json_decode('{"CardTypeObjectData": 1}', true)
            )
        );

        $this->cardTypeService->processForm('{"CardTypeObjectData": 1}', $formMock);
    }

    public function set($entity, $value, $propertyName = 'id')
    {
        $class = new ReflectionClass($entity);
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);

        $property->setValue($entity, $value);
    }
}