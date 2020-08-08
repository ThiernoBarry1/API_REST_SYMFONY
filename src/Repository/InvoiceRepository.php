<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Invoice;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Invoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Invoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Invoice[]    findAll()
 * @method Invoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }
/**
 *  retourn le dernier chrono
 */
    
    public function findByNextChrono(User $user)
    {
        return $this->createQueryBuilder('i')
            ->select("i.chrono")
            ->join("i.customer","c")
            ->where('c.user = :user')
            ->setParameter('user', $user)
            ->orderBy('i.chrono', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleScalarResult() +  1
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Invoice
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
