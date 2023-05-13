<?php

namespace App\Repository\Api;

use App\Entity\Api\Airport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Airport>
 *
 * @method Airport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Airport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Airport[]    findAll()
 * @method Airport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirportRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Airport::class);
    }

    /**
     * @param Airport $entity
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Airport $entity, bool $flush = false): void
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
     * @param Airport $entity
     * @param bool $flush
     * @return void
     */
    public function remove(Airport $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
