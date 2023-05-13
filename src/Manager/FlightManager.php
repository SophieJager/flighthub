<?php

namespace App\Manager;

use App\Contract\Manager\FlightManagerInterface;
use App\Entity\Flight;
use App\Repository\FlightRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FlightManager extends AbstractManager implements FlightManagerInterface
{
    /**
     * @var FlightRepository $repository
     */
    protected $repository;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $repo = $entityManager->getRepository(FlightManager::class);
        if (!$repo instanceof FlightRepository) {
            throw new InvalidArgumentException(sprintf(
                'The repository class for "%s" must be "%s" and given "%s"! ' .
                'Maybe look the "repositoryClass" declaration on %s ?',
                Flight::class,
                FlightRepository::class,
                get_class($repo),
                Flight::class
            ));
        }
        $this->repository = $repo;
        parent::__construct($entityManager, $validator);
    }

    /**
     * @param Flight $flight
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Flight $flight, bool $flush = true): void
    {
        $this->repository->createOrUpdate($flight, $flush);
    }
}
