<?php
namespace App\Service;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class PostDownloader
{
    public function __construct(
        public EntityManagerInterface $entityManager,
    ) {}

    public function generateData(): void
    {
        $responsePosts = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts'), true);
        $responseUsers = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/users'), true);

        foreach ($responsePosts as $singlePost) {
            foreach ($responseUsers as $singleUser) {
                if ($singlePost['userId'] == $singleUser['id'])
                {
                    $post = new Post;
                    $post->setTitle($singlePost['title']);
                    $post->setBody($singlePost['body']);
                    $post->setAuthor($singleUser['name']);
                }
            }
            $this->entityManager->persist($post);
        }
        $this->entityManager->flush();
    }
}