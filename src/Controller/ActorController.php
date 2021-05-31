<?php

namespace App\Controller;

use App\Entity\Actor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/actor", name="actor_")
     */
class ActorController extends AbstractController
{
    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function index(Actor $actor): Response
    {
        return $this->render('actor/index.html.twig', [
            'actor' => $actor,
        ]);
    }
}
