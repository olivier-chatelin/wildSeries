<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CategoryType;
    /**
     * @Route("/categories", name="categories_")
     */
class CategoryController extends AbstractController
{
    /**
     * The controller for the category add form
     * Display the form or deal with it
     *
     * @Route("/new", name="new")
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request) : Response
    {
        // Create a new Category Object
        $category = new Category();
        // Create the associated Form
        $form = $this->createForm(CategoryType::class, $category);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted()) {
          $manager = $this->getDoctrine()->getManager();
          $manager->persist($category);
          $manager->flush();
            return $this->redirectToRoute('categories_index');
        }
        // Render the form
        return $this->render('category/new.html.twig', ["form" => $form->createView()]);
    }
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
