<?php

namespace AppBundle\Command\Import;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Category;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class ArticleImportCommand
 * @package AppBundle\Command\Import
 */
class ArticleImportCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sf-blog:import:article')
            ->setDescription('Import article');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Import article</info>');

        $startTime = time();

        $articleFile = $this->getContainer()->get('kernel')->getRootDir().'/Resources/data/import/articles.csv';
        $articleCsv = fopen($articleFile, "r");
        $nbArticle = count(file($articleFile));

        $progressBar = new ProgressBar($output, $nbArticle);
        $progressBar->start();

        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $current = 1;

        while($articleRow = fgetcsv($articleCsv, '', ';')) {
            if ($current != 1) {

                $date = \DateTime::createFromFormat('d/m/Y', $articleRow[2]);
                $date->format('Y-m-d');

                $article = new Article();
                $article
                    ->setTitle($articleRow[0])
                    ->setContent($articleRow[1])
                    ->setDate($date);

                $categoryIds = explode('-', $articleRow[3]);

                foreach ($categoryIds as $categoryId) {
                    $category = $entityManager->getRepository(Category::class)->find($categoryId);

                    $article->addCategory($category);
                }

                $entityManager->persist($article);
                $entityManager->flush();

                $progressBar->advance();
            }

            $current++;
        }

        fclose($articleCsv);

        $progressBar->finish();

        $endTime = time();
        $resTime = $endTime - $startTime;

        $output->writeln(' > <comment>Memory usage: ' . memory_get_usage() . '</comment>');
        $output->writeln(' > <info>OK duration: ' . $resTime . ' seconds</info>');
     }
}
