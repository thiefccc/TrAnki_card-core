<?php

namespace App\Service;

use App\Entity\Card;
use App\Repository\CardRepository;
use Psr\Log\LoggerInterface;

class CardService
{
    /**
     * @var CardRepository
     */
    private $cardRepository;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        CardRepository $cardRepository,
        LoggerInterface $logger
    ) {
        $this->cardRepository = $cardRepository;
        $this->logger = $logger;
    }

    /**
     * @param Card $card
     */
    public function save(Card $card): void
    {
        $this->logger->info('Add a Card with value ' . $card->getFrontValue());
//        $this->cardRepository->create($card);
    }
}