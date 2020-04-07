<?php

namespace App\Service\v1;

use App\Entity\CardType;
use App\Repository\CardTypeRepository;
use Symfony\Component\Form\FormInterface;

class CardTypeService
{
    /**
     * @var CardTypeRepository
     */
    private $cardTypeRepository;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(CardTypeRepository $cardTypeRepository)
    {
        $this->cardTypeRepository = $cardTypeRepository;
    }

    /**
     * @param CardType $cardType
     * @return array
     */
    public function serializeCardType(CardType $cardType): array
    {
        return [
            'id' => $cardType->getId(),
            'name' => $cardType->getName(),
        ];
    }

    public function processForm(string $requestContent, FormInterface $form)
    {
        $data = json_decode($requestContent, true);
        $form->submit($data);
    }
}