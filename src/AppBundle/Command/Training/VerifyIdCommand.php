<?php

namespace AppBundle\Command\Training;

use AppBundle\Entity\Article\Article;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class VerifyIdCommand
 * @package AppBundle\Command\Training
 */
class VerifyIdCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sf-blog:training:id')
            ->setDescription('Training verify id')
            ->addArgument('id', InputArgument::REQUIRED, 'Enter Id !');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Training verify Id</info>');

        $startTime = time();

        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $inputId = $input->getArgument('id');
        $getIds = [];
        $getIds[] = $inputId;

        $articleIds = explode(',', $getIds[0]);

        foreach ($articleIds as $articleId) {
            $getId = $entityManager->getRepository(Article::class)->find($articleId);

            if ($getId) {
                $output->writeln('find the id successfully :)');
            } else {
                $output->writeln('Error : Id not found !');
            }
        }
        
        $endTime = time();
        $resTime = $endTime - $startTime;

        $output->writeln(' > <comment>Memory usage: ' . memory_get_usage() . '</comment>');
        $output->writeln(' > <info>OK duration: ' . $resTime . ' seconds</info>');
    }
}
