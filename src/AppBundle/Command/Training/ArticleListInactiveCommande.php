<?php

namespace AppBundle\Command\Training;

use AppBundle\Entity\Article\Article;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ArticleListInactiveCommande
 * @package AppBundle\Command\Training
 */
class ArticleListInactiveCommande extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sf-blog:article:list-inactive')
            ->setDescription('Training verify Inactive id');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Training verify Id</info>');

        $startTime = time();

        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $inactiveArticles = $entityManager->getRepository(Article::class)->findInactives();

        $listInactiveId = [];

        foreach($inactiveArticles as $inactiveArticle) {
            $listInactiveId[] =  $inactiveArticle->getId();
        }

        $output->writeln('Idle list of inactive items : ' . implode(',', $listInactiveId));

        $endTime = time();
        $resTime = $endTime - $startTime;

        $output->writeln(' > <comment>Memory usage: ' . memory_get_usage() . '</comment>');
        $output->writeln(' > <info>OK duration: ' . $resTime . ' seconds</info>');
    }
}
