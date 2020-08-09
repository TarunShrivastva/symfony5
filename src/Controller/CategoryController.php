<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="category")
     */
    public function index(EntityManagerInterface $em, Request $request, PaginatorInterface $paginator)
    {
        $repository = $em->getRepository(Article::class);
        $queryBuilder = $repository->findAllByStatus();

        $articles = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        // dd($articles);

        return $this->render('category/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
