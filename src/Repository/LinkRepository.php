<?php

namespace App\Repository;

use App\Entity\Link;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Link|null find($id, $lockMode = null, $lockVersion = null)
 * @method Link|null findOneBy(array $criteria, array $orderBy = null)
 * @method Link[]    findAll()
 * @method Link[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkRepository extends ServiceEntityRepository
{
    public const ALIAS = 'l';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Link::class);
    }

    public function findAllForAdmin()
    {
        return $this->createQueryBuilder(self::ALIAS)
            ->select(
                self::ALIAS,
                CategoryRepository::ALIAS
            )
            ->leftJoin(self::ALIAS . '.category', CategoryRepository::ALIAS)
            ->orderBy(self::ALIAS . '.name', 'ASC')
            ->getQuery()
            ->getResult();
    } 

    public function findAllForShow()
    {
        return $this->createQueryBuilder(self::ALIAS)
        ->select(
            self::ALIAS,
            CategoryRepository::ALIAS
        )
        ->join(self::ALIAS . '.category', CategoryRepository::ALIAS)
        ->Where(self::ALIAS . '.isEnable = :enable')
        ->setParameters(['enable' => true])

        ->orderBy(CategoryRepository::ALIAS . '.name', 'ASC')
        ->addOrderBy(self::ALIAS . '.name', 'ASC')
    
        ->getQuery()
        ->getResult();
    }

    public function findAllForAjax()
    {
        return $this->createQueryBuilder(self::ALIAS)
        ->select(
            self::ALIAS. '.id',
            self::ALIAS. '.name',
            self::ALIAS. '.content',
            self::ALIAS. '.link',
            self::ALIAS. '.isSecure',
            CategoryRepository::ALIAS . '.name as category',
            CategoryRepository::ALIAS . '.icon'
        )
        ->join(self::ALIAS . '.category', CategoryRepository::ALIAS)
        ->Where(self::ALIAS . '.isEnable = :enable')
        ->setParameters(['enable' => true])

        ->orderBy(CategoryRepository::ALIAS . '.name', 'ASC')
        ->addOrderBy(self::ALIAS . '.name', 'ASC')
    
        ->getQuery()
        ->getResult();
    }
}
