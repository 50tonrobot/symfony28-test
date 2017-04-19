<?php
namespace Neo\NasaBundle\Service;
use Neo\NasaBundle\Document\Neo;
use Guzzle\Http\Client;

class NasaWebService {

  private $client;
  private $neo;

  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  public function fetchNeoData()
  {

    $request = $this->client->get('feed?start_date=2017-03-01&end_date=2017-03-05&detailed=true&api_key=N7LkblDsc5aen05FJqBQ8wU4qSdmsftwJagVK7UD');

    $response = $request->send();

    $response_array = json_decode($response->getBody());

    $returnObject = array();
    $returnObject["elementCount"] = $response_array->element_count;
    $returnObject["neoDocuments"] = array();

    foreach ($response_array->near_earth_objects as $date => $neoArray)
    {
      foreach ($neoArray as $index => $neoObject)
      {
        $neo = new Neo();
        $neo->setNeoReferenceId($date);
        $neo->setDate($neoObject->neo_reference_id);
        $neo->setName($neoObject->name);
        $neo->setKilometersPerHour($neoObject->close_approach_data[0]->relative_velocity->kilometers_per_hour);
        $neo->setIsPotentiallyHazardousAsteroid($neoObject->is_potentially_hazardous_asteroid);
        $returnObject["neoDocuments"][] = $neo;
      }
    }

    return $returnObject;
  }

}
 ?>
