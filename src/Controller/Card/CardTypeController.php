<?php

namespace App\Controller\Card;

use App\Entity\CardType;
use App\Repository\CardTypeRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/card-type")
 * Class CardTypeController
 * @package App\Controller
 */
class CardTypeController extends AbstractFOSRestController
{
    /**
     * @var CardTypeRepository
     */
    private $cardTypeRepository;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        CardTypeRepository $cardTypeRepository,
        LoggerInterface $logger
    )
    {
        $this->cardTypeRepository = $cardTypeRepository;
        $this->logger = $logger;
    }

    /**
     * @Post()
     */
    public function create(Request $request)
    {
        try {
            // TODO put down to the service
            $body = $request->getContent();
            $data = json_decode($body, true);
            $cardType = new CardType();
            $cardType->setName($data['name']);
            $this->logger->info('body is ' . $body);

            $this->cardTypeRepository->save($cardType);

            return new JsonResponse('Saved!');

        } catch (\Exception $e) {
            return new JsonResponse('Error: ' . $e->getMessage());
        }
    }
}