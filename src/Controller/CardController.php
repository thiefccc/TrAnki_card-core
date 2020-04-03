<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
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
     * @Route("/")
     * @return JsonResponse
     */
    public function create ()
    {
        $data = ['message' => 'No action on create!'];
        return new JsonResponse($data);
    }

    /**
     * @Route("/get/{deckId}")
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

        return new JsonResponse($cards);
    }
}