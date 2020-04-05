<?php

namespace App\Controller\Card;

use App\Entity\Card;
use App\Service\CardService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/card")
 * Class CardController
 * @package App\Controller
 */
class CardController extends AbstractFOSRestController
{
    /**
     * @var CardService
     */
    private $cardService;

    public function __construct(
        CardService $cardService
    ) {
        $this->cardService = $cardService;
    }

    /**
     * @Post()
     * @return JsonResponse
     */
    public function create ()
    {
        $data = ['message' => 'Try to create car Card'];
        $card = new Card();
        $card->setFrontValue('NEW CARD');
        $this->cardService->save($card);
        return new JsonResponse($data);
    }

    /**
     * @Get("/get/{deckId}")
     */
    public function getCards(int $deckId) {
        $cardsFromDb = [
            [
                'id' => 1,
                'front_value' => 'хуй',
                'back_value' => 'dick',
                'deck_id' => 1,
                'type_id' => 1,
            ],
            [
                'id' => 2,
                'front_value' => 'значение',
                'back_value' => 'value',
                'deck_id' => 2,
                'type_id' => 1,
            ],
        ];

        $cards = array_filter($cardsFromDb, function($elem) use ($deckId) {return $elem['deck_id'] === $deckId; });

        return $this->json($cards);
    }
}
