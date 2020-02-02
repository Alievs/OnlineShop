<?php

namespace App\Repository;

use App\Entity\CartLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CartLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartLine[]    findAll()
 * @method CartLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartLine::class);
    }


    public function findAllCartLineByUser($id)
    {
        $qb = $this->createQueryBuilder('cart_line')
            ->leftJoin('cart_line.cart', 'cart')
            ->andWhere('cart_line.cart = :cart')
            ->andWhere('cart_line.sold = :false')
            ->setParameter('cart', $id)//'cart_line.cart = : cart.id'
            ->setParameter('false', 'false')
            ->getQuery()
            ->getResult();

        return $qb;



    }

    public function findProductCartLine($cartline_id)
    {
        $qb = $this->createQueryBuilder('cart_line')
            ->leftJoin('cart_line.product', 'product')
            ->andWhere('cart_line.product = :product')
            ->setParameter('product', $cartline_id)//'cart_line.cart = : cart.id'
            ->getQuery()
            ->getResult();

        return $qb;



    }

}
