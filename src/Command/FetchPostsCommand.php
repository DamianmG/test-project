<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'FetchPostsCommand',
    description: 'Fetching posts and saving it into database',
    aliases: ['app:fetch-posts']
)]
class FetchPostsCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $client = HttpClient::create();

        $apiBaseUrl = 'https://jsonplaceholder.typicode.com';

        try {
            // Make a GET request to the API for posts
            $postsResponse = $client->request('GET', $apiBaseUrl.'/posts');

            // Decode posts response
            $posts = $postsResponse->toArray();

            // Make a GET request to the API for users
            $usersResponse = $client->request('GET', $apiBaseUrl.'/users');

            // Decode users response
            $users = $usersResponse->toArray();

            foreach ($posts as $post) {
                // Find the user corresponding to the post's userId
                $user = null;
                foreach ($users as $userData) {
                    if ($userData['id'] === $post['userId']) {
                        $user = $userData;
                        break;
                    }
                }
            
                if ($user) {
                    // Create and persist a Post entity for each fetched post
                    $newPost = (new Post())
                        ->setTitle($post['title'])
                        ->setBody($post['body'])
                        ->setUserName($user['username']);
            
                    $this->entityManager->persist($newPost);
                    $output->writeln('Saved post: ' . $newPost->getTitle() . ' by ' . $newPost->getUserName());
                } else {
                    $output->writeln('Could not find user for post with userId: ' . $post['userId']);
                }
            }

            // Flush all persisted entities to the database
            $this->entityManager->flush();

            $output->writeln('Posts fetched and saved successfully.');

            return Command::SUCCESS;

        } catch (\Exception $e) {

            $output->writeln('Error fetching and saving posts: ' . $e->getMessage());

            return Command::FAILURE;
        }
    }
}
