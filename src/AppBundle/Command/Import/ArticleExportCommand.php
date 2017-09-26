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
        $nbArticle = count(file($articleFile));

        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $articles = $entityManager->getRepository(Article::class)->findAll();

        $progressBar = new ProgressBar($output, $nbArticle);
        $progressBar->start();

        fputcsv($articleCsv,
           [
                'TITLE',
                'AUTHOR',
                'CONTENT',
                'DATE',
            ],
         ',');

        $current = 1;

        while($articleRow = $articles)
        {
            fputcsv($articleCsv,
                [
                    $articleRow['title'],
                    $articleRow['author'],
                    $articleRow['content'],
                    $articleRow['date'],
                ],
            ';');

            $current++;
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
