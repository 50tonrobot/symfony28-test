<?php
namespace Neo\NasaBundle\Service;
use Neo\NasaBundle\Document\Neo;
use Guzzle\Http\Client;

class NasaWebService {

  private $client;
  private $neo;
  private $uriQueryString;

  public function __construct(Client $client, $api_key)
  {

    $this->client = $client;
    $this->uriQueryString = "feed?".
                            "start_date=".date('Y-m-d', strtotime('-4 days', time()))."&".
                            "end_date=".date('Y-m-d', strtotime('-1 days', time()))."&".
                            "detailed=true&".
                            "api_key={$api_key}";
  }

  public function fetchNeoData()
  {


    $request = $this->client->get($this->uriQueryString);

    $response = $request->send();

    $response_array = json_decode($response->getBody());

    $returnObject = array();
    $returnObject["elementCount"] = $response_array->element_count;
    $neoDocumentArray = array();

    foreach ($response_array->near_earth_objects as $date => $neoArray)
    {
      foreach ($neoArray as $index => $neoObject)
      {
        $neo = new Neo();
        $neo->setNeoReferenceId(intval($neoObject->neo_reference_id));
        $neo->setDate($date);
        $neo->setName($neoObject->name);
        $neo->setKilometersPerHour($neoObject->close_approach_data[0]->relative_velocity->kilometers_per_hour);
        $neo->setIsPotentiallyHazardousAsteroid($neoObject->is_potentially_hazardous_asteroid);
        $neoDocumentArray[] = $neo;
      }
    }

    $returnObject["neoArray"] = $this->neoCollectionAdapter($neoDocumentArray);

    return $returnObject;
  }

  public function neoCollectionAdapter($neoDocumentArray)
  {
    //Allow a single Neo Document to be passed, and wrapped into an array.
    if(gettype($neoDocumentArray) != 'array')
    {
      $neoDocumentArray = array($neoDocumentArray);
    }
    $neoArray = array();
    foreach ($neoDocumentArray as $index => $neoDocument) {
      $currentNeo['neo_reference_id'] = $neoDocument->getNeoReferenceId();
      $currentNeo['date'] = $neoDocument->getDate();
      $currentNeo['name'] = $neoDocument->getName();
      $currentNeo['kilometers_per_hour'] = $neoDocument->getKilometersPerHour();
      $currentNeo['is_potentially_hazardous_asteroid'] = $neoDocument->getIsPotentiallyHazardousAsteroid();
      $neoArray[] = $currentNeo;
    }
    return $neoArray;
  }

}
 ?>
