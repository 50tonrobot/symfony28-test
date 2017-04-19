<?php
namespace Neo\NasaBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchNeoDataCommand extends Command
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
    }
}
?>
