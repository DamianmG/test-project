<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PostRepository;

class PostController extends AbstractController
{
    #[Route('/lista', name: 'post_list')]
    public function postList(PostRepository $postRepository): Response 
    {
        $posts = $postRepository->findAll();

        return $this->render('post/post_list.html.twig', [
            'posts' => $posts,
        ]);
    }
}
