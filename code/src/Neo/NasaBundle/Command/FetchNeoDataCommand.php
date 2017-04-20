<?php
namespace Neo\NasaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
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
          ->setDescription('Fetches data on Near Earth Objects collected by Nasa over the previous 3 days.')

          // the full command description shown when running the command with
          // the "--help" option
          ->setHelp('This command Fetches Neo data over the previous 3 days, no options available')
      ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $NeoFetchService = $this->getContainer()->get('neo.fetchData');
        $returnObject = $NeoFetchService->fetchNeoData();
        foreach ($returnObject["neoArray"] as $index => $currentNeo) {
          $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();
          $neo = $dm->getRepository('NasaBundle:Neo')->findOneBy(array( 'neo_reference_id' => $currentNeo['neo_reference_id'] ));
          if(is_null($neo)===true)
          {
            $dm->persist($neoDocument);
            $dm->flush();
          }
        }
        $output->writeln($returnObject["elementCount"]." Neo's found");
    }
}
?>
