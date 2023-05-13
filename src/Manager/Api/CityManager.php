<?php

namespace App\Manager\Api;

use App\Contract\Manager\Api\CityManagerInterface;
use App\Entity\Api\City;
use App\Manager\AbstractManager;
use App\Repository\Api\CityRepository;
use InvalidArgumentException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CityManager extends AbstractManager implements CityManagerInterface
{
    /**
     * @var CityRepository $repository
     */
    protected $repository;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $repo = $entityManager->getRepository(CityManager::class);
        if (!$repo instanceof CityRepository) {
            throw new InvalidArgumentException(sprintf(
                'The repository class for "%s" must be "%s" and given "%s"! ' .
                'Maybe look the "repositoryClass" declaration on %s ?',
                City::class,
                CityRepository::class,
                get_class($repo),
                City::class
            ));
        }
        $this->repository = $repo;
        parent::__construct($entityManager, $validator);
    }

    /**
     * @param City $city
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(City $city, bool $flush = true): void
    {
        $this->repository->createOrUpdate($city, $flush);
    }
}
