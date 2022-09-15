<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voiture>
 *
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    public function add(Voiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Voiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Voiture[] Returns an array of string objects
     */
    public function findByCarburant(): array
    {
        return $this->createQueryBuilder('v')
            ->groupBy('v.carburant')
            ->distinct()
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Voiture[] Returns an array of string objects
     */
    public function findByCategorie(): array
    {
        return $this->createQueryBuilder('v')
            ->groupBy('v.categorie')
            ->distinct()
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Voiture[] Returns an array of string objects
     */
    public function findByTransmission(): array
    {
        return $this->createQueryBuilder('v')
            ->groupBy('v.transmission')
            ->distinct()
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Voiture[] Returns an array of Voiture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Voiture
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    /**
     * @return Voiture[] Returns an array of string objects
     */
    public function searchVoture($search_transmission, $search_categorie, $search_carburant)
    {
        return $this->createQueryBuilder('v')
            ->where('LOWER(v.transmission) like LOWER(:transmission)')
            ->setParameter('transmission', '%'.$search_transmission.'%')
            ->andWhere('LOWER(v.categorie) like LOWER(:categorie)')
            ->setParameter('categorie', '%'.$search_categorie.'%')
            ->andWhere('LOWER(v.carburant) like LOWER(:carburant)')
            ->setParameter('carburant', '%'.$search_carburant.'%')
            ->getQuery()
            ->getResult()
            ;
    }
}
