<?php
namespace Neo\NasaBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/*
* element_count
* near_earth_objects.{date}.
*/

/**
 * @MongoDB\Document(repositoryClass="Neo\NasaBundle\Repository\NewRepository")
 */
class Neo
{
  /**
   * @MongoDB\Id
   */
   protected $neo_reference_id;

   /**
    * @MongoDB\Field(type="date")
    */
   protected $date;

   /**
    * @MongoDB\Field(type="string")
    */
   protected $name;

   /**
    * @MongoDB\Field(type="float")
    */
   protected $kilometers_per_hour;
   //close_approach_data.relative_velocity.kilometers_per_hour

   /**
    * @MongoDB\Field(type="boolean")
    */
   protected $is_potentially_hazardous_asteroid;
}
?>
