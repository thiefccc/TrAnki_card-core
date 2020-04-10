<?php

namespace App\Controller\v1\Card;

use App\Entity\CardType;
use App\Form\CardTypeForm;
use App\Repository\CardTypeRepository;
use App\Service\v1\CardTypeService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    /**
     * @var CardTypeService
     */
    private $cardTypeService;

    /**
     * CardTypeController constructor.
     * @param CardTypeRepository $cardTypeRepository
     * @param CardTypeService $cardTypeService
     * @param LoggerInterface $logger
     * @codeCoverageIgnore
     */
    public function __construct(
        CardTypeRepository $cardTypeRepository,
        CardTypeService $cardTypeService,
        LoggerInterface $logger
    ) {
        $this->cardTypeRepository = $cardTypeRepository;
        $this->cardTypeService = $cardTypeService;
        $this->logger = $logger;
    }

    /**
     * @Post(name="add_card_type")
     */
    public function createCardType(Request $request)
    {
        try {
            // TODO put down to the service
            $cardType = new CardType();
            $form = $this->createForm(CardTypeForm::class, $cardType);
            $this->cardTypeService->processForm($request->getContent(), $form);

            $this->cardTypeRepository->save($cardType);

            // TODO in service
            $cardTypeUrl = $this->generateUrl(
                'get_card_type_by_id', [
                    'cardTypeId' => $cardType->getId()
                ]);

            $response_data = $this->cardTypeService->serializeCardType($cardType);

            $request = new JsonResponse($response_data, Response::HTTP_CREATED, [], true);
            $request->headers->set('Location', $cardTypeUrl);
            return $request;
        } catch (\Exception $e) {
            return new JsonResponse('Error: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Put("/{cardTypeId<\d+>}", name="update_card_type")
     * @codeCoverageIgnore
     */
    public function updateCardType($cardTypeId, Request $request)
    {
        $cardType = $this->cardTypeRepository->find($cardTypeId);

        // TODO remove duplication of code
        if (!$cardType) {
            return new JsonResponse(
                'Card type (ID: ' . $cardTypeId . ') hasn\'t been found',
                Response::HTTP_NOT_FOUND
            );
        }

        $form = $this->createForm(CardTypeForm::class, $cardType);
        $this->cardTypeService->processForm($request->getContent(), $form);

        $this->cardTypeRepository->save($cardType);
        $response_data = $this->cardTypeService->serializeCardType($cardType);
        return new JsonResponse($response_data, Response::HTTP_OK, [], true);
    }

    /**
     * @Delete("/{cardTypeId<\d+>}", name="delete_card_type")
     * @codeCoverageIgnore
     */
    public function deleteCardType($cardTypeId)
    {
        $cardType = $this->cardTypeRepository->find($cardTypeId);

        if ($cardType) {
            $this->cardTypeRepository->delete($cardType);
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Get(name="get_all_card_types")
     * @codeCoverageIgnore
     */
    public function getAllCardTypes()
    {
        $cardTypes = $this->cardTypeRepository->findAll();

        if (empty($cardTypes)) {
            return new JsonResponse('No one Card type haven\'t been found', Response::HTTP_NOT_FOUND);
        }

        $data = $this->cardTypeService->serializeCardTypes(['card_types' => $cardTypes]);
        return new JsonResponse($data,Response::HTTP_FOUND, [], true);
    }

    /**
     * @Get("/{cardTypeId<\d+>}", name="get_card_type_by_id")
     * @codeCoverageIgnore
     * @return object|void
     */
    public function getCardTypeById($cardTypeId)
    {
        // TODO put down to service
        $cardType = $this->cardTypeRepository->find($cardTypeId);

        if (!$cardType) {
            return new JsonResponse('Card type (ID: ' . $cardTypeId . ') hasn\'t been found', Response::HTTP_NOT_FOUND);
        }

        // TODO serialize objects with appropriate service
        $data = $this->cardTypeService->serializeCardType($cardType);

        return new JsonResponse($data,Response::HTTP_FOUND, [], true);
    }

    /**
     * @Get("/{cardTypeName<[a-zA-Z]+>}", name="get_card_type_by_name")
     * @codeCoverageIgnore
     * @return object|void
     */
    public function getCardTypeByName($cardTypeName)
    {
        // TODO put down to service
        $cardType = $this->cardTypeRepository->findOneBy(['name' => $cardTypeName]);

        if ($cardType) {
            // TODO serialize objects
            $data = [
                'id' => $cardType->getId(),
                'name' => $cardType->getName(),
            ];

            return new JsonResponse($data,Response::HTTP_FOUND, [], true);
        } else {
            return new JsonResponse('Card type (Name: ' . $cardTypeName . ') hasn\'t been found', Response::HTTP_NOT_FOUND);
        }
    }
}