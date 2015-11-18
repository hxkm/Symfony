<?php

namespace Test\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
* ArticleRepository
*
* This class was generated by the Doctrine ORM. Add your own custom
* repository methods below.
*/
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
  function myFindAll()
  {

    /*
    On peut aussi faire $this->_em->createQuery('SELECT a FROM TestBlogBundle:Article a');
    $resultat = $query->getResult();
    */

    return $this->createQueryBuilder('a')
    ->getQuery()
    ->getResult();
  }

  function getArticlesAvecCommentaires()
  {
    $qb = $this->createQueryBuilder('a')
    ->leftJoin('a.commentaires','c')
    ->addSelect('c');

    return $qb->getQuery()->getResult();
  }

  public function getArticles($nombreParPage,$page)
  {
    if ($page < 1) {
      throw new \InvalidArgumentException('L\'argument "$page" ne peut pas être inférieur à 1 .');
    }

    $query = $this->createQueryBuilder('a')
    ->leftJoin('a.image','i')
    ->addSelect('i')
    ->leftJoin('a.categories','c')
    ->addSelect('c')
    ->OrderBy('a.date','DESC')
    ->getQuery();

    $query->setFirstResult(($page-1)*$nombreParPage)
    ->setMaxResults($nombreParPage);

    return new Paginator($query);
  }

  public function findById ($id)
  {
    $qb = $this->createQueryBuilder('a');
    $qb->leftJoin('a.categories','c')
       ->where($qb->expr()->in('a.id',$id))
       ->addSelect('c');


    return $qb->getQuery()->getSingleResult();
  }

    public function findByCategory($category_name)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->innerJoin('a.categories','c')
            ->where($qb->expr()->in('c.nom',$category_name));



        return $qb->getQuery()->getResult();
    }

  
}
