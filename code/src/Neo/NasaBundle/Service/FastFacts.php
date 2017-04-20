<?php
namespace Neo\NasaBundle\Service;

class FastFacts
{
  private $dm;

  public function __construct($dm)
  {
    $this->dm = $dm;
  }

  public function fetchFastest()
  {
    $query = $this->dm->createQueryBuilder('NasaBundle:Neo')
        ->sort('kilometers_per_hour', 'DESC')
        ->limit(1)
        ->getQuery();
    return $query->getSingleResult();
  }

  public function fetchHazards()
  {
    return $this->dm->getRepository('NasaBundle:Neo')->findBy(
        array('is_potentially_hazardous_asteroid' => true),
        array('date' => 'ASC')
    );

  }
}

?>
