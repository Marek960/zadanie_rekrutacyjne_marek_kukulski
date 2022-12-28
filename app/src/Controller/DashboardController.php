<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use App\Service\PostService;

class DashboardController extends AbstractController
{
    public function __construct(
        public PostService $postService
    ) {}

    #[Route('/lista', name: 'lista')]
    public function index(): Response
    {
        $posts = $this->postService->listPosts() ?? null;

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'posts' => $posts
        ]);
    }

    #[Route('/{id}', name: 'post_delete', methods: 'POST', requirements:["id"=>"\d+"])]
    public function delete(Request $request, Post $post): Response
    {
        $token = $request->request->get('_token');
        if ($this->isCsrfTokenValid('delete-item', $token)) {
            $this->postService->removePost($post, $token); 
            return $this->redirectToRoute('lista', [], Response::HTTP_SEE_OTHER);
        }
    }
}
