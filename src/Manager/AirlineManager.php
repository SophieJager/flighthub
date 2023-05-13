<?php

namespace App\Manager;

use App\Contract\Manager\AirlineManagerInterface;
use App\Entity\Airline;
use App\Repository\AirlineRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AirlineManager extends AbstractManager implements AirlineManagerInterface
{
    /**
     * @var AirlineRepository $repository
     */
    protected $repository;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $repo = $entityManager->getRepository(AirlineManager::class);
        if (!$repo instanceof AirlineRepository) {
            throw new InvalidArgumentException(sprintf(
                'The repository class for "%s" must be "%s" and given "%s"! ' .
                'Maybe look the "repositoryClass" declaration on %s ?',
                Airline::class,
                AirlineRepository::class,
                get_class($repo),
                Airline::class
            ));
        }
        $this->repository = $repo;
        parent::__construct($entityManager, $validator);
    }

    /**
     * @param Airline $airline
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Airline $airline, bool $flush = true): void
    {
        $this->repository->createOrUpdate($airline, $flush);
    }
}
