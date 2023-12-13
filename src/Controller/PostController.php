<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;

class PostController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/lista', name: 'post_list')]
    public function postList(PostRepository $postRepository): Response 
    {
        $posts = $postRepository->findAll();

        return $this->render('post/post_list.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/delete-post/{postId}', methods:['GET', 'DELETE'], name: 'delete_post')]
    public function delete(PostRepository $postRepository, $postId): Response
    {
        $post = $postRepository->find($postId);
        
        $this->entityManager->remove($post);
        $this->entityManager->flush();

        $this->addFlash('success', 'Post deleted successfully.');

        return $this->redirectToRoute('post_list');
    }
}
