<?php
namespace AppBundle\Command;
use Pimcore\Model\DataObject;
use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('import:command')
            ->setDescription('Import Users, Categories and Posts');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // dump
        $this->dump("Importing Users");

        // add newlines through flags
        $this->dump("Importing Categories", Dumper::NEWLINE_BEFORE | Dumper::NEWLINE_AFTER);

        // only dump in verbose mode
        $this->dumpVerbose("Importing Posts", Dumper::NEWLINE_BEFORE);

        $this->ImportUsers();
        
        // Output as white text on red background.
        $this->writeError('Error occured!');
    }

    private function ImportUsers(){
        echo $path = __DIR__ . '/../Data/users.csv';
        $file = fopen($path,'r');
        while($row=fgetcsv($file, '1024')) {
            //print_r($row);
            $user = New DataObject\User();
            $user->setKey($row[0]);
            $user->setUsername($row[0]);
            $user->setFirstname($row[1]);
            $user->setLastname($row[2]);
            $user->setEmail($row[3]);
            $user->setRoles(['ROLE_USER']);
            $user->setParentId('39');
            $user->setPublished(true);
            $user->save();
            unset($user);

        }
        return(true);
    }
}