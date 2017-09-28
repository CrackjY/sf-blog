<?php

namespace AppBundle\Command\Training;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class DateCommand
 * @package AppBundle\Command\Import
 */
class DateCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sf-blog:training:date')
            ->setDescription('Training Date')
            ->addArgument('date', InputArgument::REQUIRED, 'Enter date !');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Training Date</info>');

        $startTime = time();


        $date = \DateTime::createFromFormat('d/m/Y', $input->getArgument('date'));
        $date->modify('+1 month');
        $dateFormat = $date->format('d/m/Y');

        $text = 'The ' . $dateFormat . ' ';

        $output->writeln($text.'!');

        $endTime = time();
        $resTime = $endTime - $startTime;

        $output->writeln(' > <comment>Memory usage: ' . memory_get_usage() . '</comment>');
        $output->writeln(' > <info>OK duration: ' . $resTime . ' seconds</info>');
    }
}
