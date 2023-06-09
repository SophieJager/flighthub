<?php

namespace App\Manager;

use App\Contract\Manager\AirportManagerInterface;
use App\Entity\Airport;
use App\Repository\AirportRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AirportManager extends AbstractManager implements AirportManagerInterface
{
    /**
     * @var AirportRepository $repository
     */
    protected $repository;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $repo = $entityManager->getRepository(AirportManager::class);
        if (!$repo instanceof AirportRepository) {
            throw new InvalidArgumentException(sprintf(
                'The repository class for "%s" must be "%s" and given "%s"! ' .
                'Maybe look the "repositoryClass" declaration on %s ?',
                Airport::class,
                AirportRepository::class,
                get_class($repo),
                Airport::class
            ));
        }
        $this->repository = $repo;
        parent::__construct($entityManager, $validator);
    }

    /**
     * @param Airport $airport
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Airport $airport, bool $flush = true): void
    {
        $this->repository->createOrUpdate($airport, $flush);
    }
}
