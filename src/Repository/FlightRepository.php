<?php

namespace App\Repository;

use App\Dto\Filter\FlightFilterDto;
use App\Entity\Airport;
use App\Entity\Flight;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Flight>
 *
 * @method Flight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flight[]    findAll()
 * @method Flight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flight::class);
    }

    /**
     * @param Flight $entity
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Flight $entity, bool $flush = false): void
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
     * @param Flight $entity
     * @param bool $flush
     * @return void
     */
    public function remove(Flight $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findOneWithFilters(FlightFilterDto $dto): ?Flight
    {
        $builder = $this->createQueryBuilder('f');
        if ($dto->airline !== null) {
            self::addAirlineConstraint($builder, $dto->airline);
        }
        if ($dto->date !== null) {
            self::addDateConstraint($builder, $dto->date);
        }
        if ($dto->arrivalAirport !== null) {
            self::addAirportConstraint($builder, $dto->arrivalAirport, 'arrivalAirport');
        }
        if ($dto->departureAirport !== null) {
            self::addAirportConstraint($builder, $dto->departureAirport, 'departureAirport');
        }

        $builder->orderBy('f.departureTime', 'ASC')
        ->setMaxResults(1);

        return $builder->getQuery()->getOneOrNullResult();
    }

    /**
     * @param QueryBuilder $builder
     * @param string $airline
     * @return void
     */
    public static function addAirlineConstraint(QueryBuilder $builder, string $airline): void
    {
        $builder->innerJoin('f.airline', 'al', Join::WITH, 'al.code = :airline')
            ->setParameter('airline', $airline);
    }

    /**
     * @param QueryBuilder $builder
     * @param string $airport
     * @param string $property
     * @return void
     */
    public static function addAirportConstraint(
        QueryBuilder $builder,
        string $airport,
        string $property
    ): void {
        $builder->innerJoin("f.$property", "a_$property", Join::WITH, "a_$property.code = :$property")
            ->setParameter($property, $airport);
    }

    /**
     * @param QueryBuilder $builder
     * @param DateTimeImmutable $date
     * @return void
     */
    private static function addDateConstraint(
        QueryBuilder $builder,
        DateTimeImmutable $date
    ): void {
        $builder
            ->andWhere('f.departureTime >= :date_start')
            ->andWhere('f.departureTime <= :date_end')
            ->setParameter('date_start', $date->format('Y-m-d 00:00:00'))
            ->setParameter('date_end', $date->format('Y-m-d 23:59:59'));
    }
}
