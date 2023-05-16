<?php

namespace App\Controller;

use App\Contract\Service\TripServiceInterface;
use App\Dto\Filter\TripFilterDto;
use App\Entity\Api\Trip;
use App\Enum\TripTypeEnum;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Exception;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[AsController]
class TripController extends AbstractController
{
    /**
     * @var TripServiceInterface $service
     */
    private TripServiceInterface $service;

    public function __construct(TripServiceInterface $tripService)
    {
        $this->service = $tripService;
    }

    /**
     * @param Request $request
     * @return Collection|Trip[]
     * @throws Exception
     */
    public function __invoke(Request $request): Collection
    {
        $filter = new TripFilterDto(
            $request->get('airline'),
            $request->get('departureAirport'),
            $request->get('arrivalAirport'),
            new DateTimeImmutable($request->get('departureDate')),
            new DateTimeImmutable($request->get('returnDate')),
            TripTypeEnum::from($request->get('tripType'))
        );

        return $this->service->findTrips($filter);
    }
}
