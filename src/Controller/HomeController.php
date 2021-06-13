<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    public function navbarTop(CategoryRepository $categoryRepository): Response
    {
        return $this->render('components/_navbarTop.html.twig', [
            'categories' => $categoryRepository->findBy([],['id' => 'DESC']),
        ]);
    }
}
