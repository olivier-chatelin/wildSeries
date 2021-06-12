<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Form\ActorType;
use App\Service\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/actor", name="actor_")
     */
class ActorController extends AbstractController
{
    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request, Slugify $slugify, EntityManagerInterface $manager): Response
    {
        $actor = new Actor();
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $slug = $slugify->generate($actor->getName());
            $actor->setSlug($slug);
            $manager->persist($actor);
            $manager->flush();
            return $this->redirectToRoute('actor_show',['slug'=>$actor->getSlug()]);

        }


        return $this->render('actor/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{slug}", name="show", methods={"GET"})
     */
    public function index(Actor $actor): Response
    {
        return $this->render('actor/index.html.twig', [
            'actor' => $actor,
        ]);
    }


}
