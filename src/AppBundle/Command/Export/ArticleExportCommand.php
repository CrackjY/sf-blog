<?php

namespace AppBundle\Command\Export;

use AppBundle\Entity\Article\Article;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ArticleExportCommand
 * @package AppBundle\Command\Import
 */
class ArticleExportCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sf-blog:export:article')
            ->setDescription('Export article');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Export article</info>');

        $startTime = time();

        $articleFile = $this->getContainer()->get('kernel')->getRootDir().'/Resources/data/export/articles.csv';
        $articleCsv = fopen($articleFile, "w+");

        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $articles = $entityManager->getRepository(Article::class)->findAll();

        $progressBar = new ProgressBar($output, count($articles));

        $progressBar->start();

        fputcsv($articleCsv,
           [
                'TITLE',
                'AUTHOR',
                'CONTENT',
                'DATE',
            ],
           ',');

        foreach($articles as $article) {
            fputcsv($articleCsv, array(
                    'TITLE'   => $article->getTitle(),
                    'AUTHOR'  => $article->getAuthor(),
                    'CONTENT' => $article->getContent(),
                    'DATE'   => $article->getDate()->format('d/m/Y'),
                ),
            ';');

        }

        fclose($articleCsv);

        $progressBar->advance();

        $progressBar->finish();

        $endTime = time();
        $resTime = $endTime - $startTime;

        $output->writeln(' > <comment>Memory usage: ' . memory_get_usage() . '</comment>');
        $output->writeln(' > <info>OK duration: ' . $resTime . ' seconds</info>');
    }
}
