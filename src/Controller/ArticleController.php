<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

// use Symfony\Component\Form\Extension\Core\Type\HiddenType;
// use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Doctrine\ORM\EntityManagerInterface;
// use Doctrine\ORM\EntityRepository;
// use Symfony\Bridge\Doctrine\Form\Type\EntityType;
// use Symfony\Contracts\Translation\TranslatorInterface;
// use Symfony\Component\Form\FormInterface;


class ArticleController extends AbstractController
{

    private $session;

    private $params;

    public function __construct(SessionInterface $session, ParameterBagInterface $params)
    {
        $this->session = $session;
         $this->params = $params;
    }

    /**
     * @Route(
     *      "/{_locale}/show/{id}", 
     *      name="article_show"),
     *      requirements={
     *         "_locale": "en|hi",
     *      }
     */
    public function show($id, Request $request)
    {
        $locale = $request->getLocale();
        $request->setLocale($locale);

        $rootDirectory = $this->params->get('kernel.project_dir');

        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render('article/index.html.twig', [
            'article'   => $article,
            'root_path' => $rootDirectory
        ]);
    }

    /**
     * @Route(
     *      "/latest-post/{max}", 
     *      name="latest_post"),
     */
    public function latestPost($max)
    {
        return $this->render('article/latest-post.html.twig', [
            'repeat' => $max
        ]);
    }

    /**
     * @Route(
     *      "/popular-post/{max}", 
     *      name="latest-post"),
     */
    public function popularPost($max)
    {
        return $this->render('article/popular-post.html.twig', [
            'repeat' => $max
        ]);
    }

    /**
     * @Route(
     *      "/comment-add", 
     *      name="comment-add"),
     */
    public function commentForm(Request $request, $article=null)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('comment-add'))
            ->add('comment', TextareaType::class,   ['label' => 'Add Comment'])
            ->add('created_at', DateType::class)
            ->add('updated_at', DateType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if(!empty($article))
        {
            $this->session->set('articleId', $article->getId());
        }

        if ($form->isSubmitted()) {
            $article = $this->getDoctrine()->getRepository(Article::class)->find($this->session->get('articleId'));

            $comment = new Comment();
            $comment->setComment($form->get('comment')->getData());
            $comment->setArticle( $article );
            $comment->setCreatedAt(new \DateTime());
            $comment->setUpdatedAt(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('article_show', ['_locale' => 'hi', 'id' => $article->getId()]);
        }

        return $this->render('article/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route(
     *      "/comment-list/{id}", 
     *      name="comment-list"),
     */
    public function commentList(CommentRepository $commentRepository, $article)
    {
        $comments = $commentRepository->findBy([ 'article' => $article ]);

        return $this->render('article/comment-list.html.twig', [
            'comments' => $comments,
        ]);
    }
}
