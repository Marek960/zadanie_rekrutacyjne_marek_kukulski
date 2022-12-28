<?php
namespace App\Service;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class PostService 
{
    public function __construct(
        public EntityManagerInterface $entityManager,
        public ManagerRegistry $doctrine,
    ) {}

    public function listPosts(): array
    {
        return $this->doctrine->getRepository(Post::class)->findAll();
    }

    public function removePost(Post $post, string $token): void
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }
}