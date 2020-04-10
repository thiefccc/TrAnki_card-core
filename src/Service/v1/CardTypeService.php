<?php

namespace App\Service\v1;

use App\Entity\CardType;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Form\FormInterface;

class CardTypeService
{
    /**
     * @var Serializer
     */
    private $jmsSerializer;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(SerializerInterface $jmsSerializer)
    {
        $this->jmsSerializer = $jmsSerializer;
    }

    /**
     * @param CardType $cardType
     * @return string
     */
    public function serializeCardType(CardType $cardType)
    {
        return $this->jmsSerializer->serialize($cardType, 'json');
    }

    /**
     * @param array $cardTypes
     * @return string
     */
    public function serializeCardTypes(array $cardTypes)
    {
        return $this->jmsSerializer->serialize($cardTypes, 'json');
    }

    /**
     * @param string $requestContent
     * @param FormInterface $form
     */
    public function processForm(string $requestContent, FormInterface $form): void
    {
        $data = json_decode($requestContent, true);
        $form->submit($data);
    }
}