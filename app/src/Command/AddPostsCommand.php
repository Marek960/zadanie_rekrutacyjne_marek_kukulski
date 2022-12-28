<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\PostDownloader;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name:'app:add-posts',
    description:'Add posts with relation user to table post',
)]
class AddPostsCommand extends Command
{
    public function __construct(public PostDownloader $postDownloader) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->postDownloader->generateData();
        $io = new SymfonyStyle($input, $output);
        $io->success(strtoupper('Records added to the database'));

        return Command::SUCCESS;
    }
}
