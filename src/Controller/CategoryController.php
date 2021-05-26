<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/categories", name="categories_")
     */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }
    /**
     * @Route("/{categoryName}", name="category_show")
     */
    public function show(string $categoryName): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name'=>$categoryName]);
        if (!$category){
            throw $this->createNotFoundException('The category does not exist');
        }else{
            $programs = $this->getDoctrine()
                ->getRepository(Program::class)
                ->findBy(['category'=>$category],['id'=>'DESC'],3);

        }

        return $this->render('category/show.html.twig', [
            'programs' => $programs,
        ]);
    }
}
