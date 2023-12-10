<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;

#[AsCommand(
    name: 'FetchPostsCommand',
    description: 'Fetching posts from https://jsonplaceholder.typicode.com/posts and saving it into databse',
    aliases: ['app:fetch-posts']
)]
class FetchPostsCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $client = HttpClient::create();

        $postsApiEndpoint = 'https://jsonplaceholder.typicode.com/posts';
        $usersApiEndpoint = 'https://jsonplaceholder.typicode.com/users';

        try {
            // Make a GET request to the API for posts
            $postsResponse = $client->request('GET', $postsApiEndpoint);

            // Decode posts response
            $posts = $postsResponse->toArray();
            
            // Make a GET request to the API for users
            $usersResponse = $client->request('GET', $usersApiEndpoint);
            
            // Decode users response
            $users = $usersResponse->toArray();

            foreach ($posts as $post) {
                // Your processing logic here
                $output->writeln('Fetched post: ' . $post['title']);
            }

            $output->writeln('Posts fetched successfully.');
            
            return Command::SUCCESS;

        } catch (\Exception $e) {
            
            $output->writeln('Error fetching posts: ' . $e->getMessage());
            
            return Command::FAILURE;
        }
    }
}
