<?php

namespace App\Repository\Api;

use App\Entity\Api\Airline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Airline>
 *
 * @method Airline|null find($id, $lockMode = null, $lockVersion = null)
 * @method Airline|null findOneBy(array $criteria, array $orderBy = null)
 * @method Airline[]    findAll()
 * @method Airline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirlineRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Airline::class);
    }

    /**
     * @param Airline $entity
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Airline $entity, bool $flush = false): void
    {
        /** @var int|null $id */
        $id = $entity->getId();
        if ($id === null) {
            $this->getEntityManager()->persist($entity);
        }

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param Airline $entity
     * @param bool $flush
     * @return void
     */
    public function remove(Airline $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
