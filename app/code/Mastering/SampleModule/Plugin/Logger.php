<?php
namespace Mastering\SampleModule\Plugin;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Mastering\SampleModule\Console\Command\AddItem;
class Logger {
 
    /**
     * Undocumented variable
     *
     * @var OutputInterface
     */
    private $output;
    public Function beforRun(
        AddItem $command,
        InputInterface $input,
        OutputInterface $output
    )
    {
        $output->writeln('before execution');

    }

    public function aroundRun(AddItem $command,
    \Closure $procced,
    InputInterface $input,
    OutputInterface $output)
    {
        $output->writeln('around execute before call');
        $procced->call($command,$input,$output);
        $output->writeln('around execute after call');
        $this->output=$output;


    }
    public Function afterRun(
        AddItem $command
    )
    {
        $this->output->writeln('after execution');

    }

}