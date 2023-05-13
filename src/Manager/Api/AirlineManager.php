<?php

namespace App\Manager\Api;

use App\Contract\Manager\Api\AirlineManagerInterface;
use App\Entity\Api\Airline;
use App\Manager\AbstractManager;
use App\Repository\Api\AirlineRepository;
use InvalidArgumentException;
use Doctrine\ORM\EntityManagerInterface;
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
