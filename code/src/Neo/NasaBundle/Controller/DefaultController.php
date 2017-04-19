<?php

namespace Neo\NasaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Neo\NasaBundle\Document\Neo;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function helloAction()
    {
      return new JsonResponse(array('hello' => 'world'));
    }

    /**
     * @Route("/neo")
     * @Method("POST")
     */
     public function createAction()
     {
         $params = array();
         $content = $this->get("request")->getContent();
         if (!empty($content))
         {
             $params = json_decode($content, true);
         }

         //make this a find and modify

         if(isset($params["KilometersPerHour"]))
         {
           $neo = new Neo();
           $neo->setNeoReferenceId($params["NeoReferenceId"]);
           $neo->setDate($params["Date"]);
           $neo->setName($params["Name"]);
           $neo->setKilometersPerHour($params["KilometersPerHour"]);
           $neo->setIsPotentiallyHazardousAsteroid($params["IsPotentiallyHazardousAsteroid"]);

           $dm = $this->get('doctrine_mongodb')->getManager();
           $dm->getSchemaManager()->ensureIndexes();
           $dm->persist($neo);
           try {
               $dm->flush();
           } catch (MongoCursorException $e) {
               return new Response('Already exists');
           }

           return new Response('Created Neo id '.$neo->getId());
         }
     }

    /**
     * @Route("/neo")
     * @Method("GET")
     */
    public function getNeoAction()
    {

      // Create a client and provide a base URL
      return new Response("Don't get too complex, it's a test.");
    }
}
