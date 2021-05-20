<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/programs",methods={"GET"}, name="program_")
     */
class ProgramController extends AbstractController
{
    /**
     * @Route("/{id}",requirements={"id"="\d+"}, name="show")
     */
    public function show($id): Response
    {
        return $this->render('program/show.html.twig', [
            'id' => $id,
        ]);
    }
}
