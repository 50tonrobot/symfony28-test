<?php
namespace Neo\NasaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchNeoDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
      $this
          // the name of the command (the part after "app/console")
          ->setName('app:fetch-neo-data')

          // the short description shown while running "php app/console list"
          ->setDescription('Fetches data on Near Earth Objects collected by Nasa over the last 3 days.')

          // the full command description shown when running the command with
          // the "--help" option
          ->setHelp('This command allows you Fetch Neo data and has no options...')
      ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Whoa!');

        $NeoFetchService = $this->getContainer()->get('neo.fetchData');
        $returnObject = $NeoFetchService->fetchNeoData();
        foreach ($returnObject["neoDocuments"] as $index => $neoDocument) {
          $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();
          $neo = $dm->getRepository('NeoRepository')->findOneBy(array('neo_reference_id' => $neoDocument->getNeoReferenceId()));
          $output->writeln("this is a neo: ".$neo->getNeoReferenceId());
          /*
          $dm->getSchemaManager()->ensureIndexes();
          $dm->persist($neoDocument);
          try {
              $dm->flush();
          } catch (MongoCursorException $e) {
              return new Response('Already exists');
          }
          */
        }
        $output->writeln($returnObject["elementCount"]." Neo's found");
    }
}
?>
