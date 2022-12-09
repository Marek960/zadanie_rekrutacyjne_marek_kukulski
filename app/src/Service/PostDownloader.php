<?php
namespace App\Service;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class PostDownloader
{
    public function __construct(
        public EntityManagerInterface $entityManager
    ) {}

    public function generateData()
    {
        $requestPosts = file_get_contents('https://jsonplaceholder.typicode.com/posts');
        $responsePosts = json_decode($requestPosts, true);
        $requestUsers = file_get_contents('https://jsonplaceholder.typicode.com/users');
        $responseUsers = json_decode($requestUsers, true);

        foreach ($responsePosts as $singlePost) {
            foreach ($responseUsers as $key => $singleUser) {
                if($singlePost['userId'] == $singleUser['id'])
                {
                    $post = new Post();
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
//php bin/console app:add-posts