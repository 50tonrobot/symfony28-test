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
   protected $id;

  /**
   * @MongoDB\Field(type="int") @MongoDB\Index(unique=true, order="asc")
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

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set neoReferenceId
     *
     * @param int $neoReferenceId
     * @return $this
     */
    public function setNeoReferenceId($neoReferenceId)
    {
        $this->neo_reference_id = $neoReferenceId;
        return $this;
    }

    /**
     * Get neoReferenceId
     *
     * @return int $neoReferenceId
     */
    public function getNeoReferenceId()
    {
        return $this->neo_reference_id;
    }

    /**
     * Set date
     *
     * @param date $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return date $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set kilometersPerHour
     *
     * @param float $kilometersPerHour
     * @return $this
     */
    public function setKilometersPerHour($kilometersPerHour)
    {
        $this->kilometers_per_hour = $kilometersPerHour;
        return $this;
    }

    /**
     * Get kilometersPerHour
     *
     * @return float $kilometersPerHour
     */
    public function getKilometersPerHour()
    {
        return $this->kilometers_per_hour;
    }

    /**
     * Set isPotentiallyHazardousAsteroid
     *
     * @param boolean $isPotentiallyHazardousAsteroid
     * @return $this
     */
    public function setIsPotentiallyHazardousAsteroid($isPotentiallyHazardousAsteroid)
    {
        $this->is_potentially_hazardous_asteroid = $isPotentiallyHazardousAsteroid;
        return $this;
    }

    /**
     * Get isPotentiallyHazardousAsteroid
     *
     * @return boolean $isPotentiallyHazardousAsteroid
     */
    public function getIsPotentiallyHazardousAsteroid()
    {
        return $this->is_potentially_hazardous_asteroid;
    }
}
