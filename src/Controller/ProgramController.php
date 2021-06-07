<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\ProgramType;
use App\Service\Slugify;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;



    /**
     * @Route("/programs", name="program_")
     */
class ProgramController extends AbstractController
{
    /**
     * @Route("/new", name="new")
     * @return Response
     */
    public function new(Request $request, Slugify $slugify, MailerInterface$mailer):Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class,$program);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $slug = $slugify->generate($program->getTitle());
            $program->setSlug($slug);
            $entityManager->persist($program);
            $entityManager->flush();
            $email = (new TemplatedEmail())
                ->from($this->getParameter('mailer_from'))
                ->to('olivier.chatelin@gmail.com')
                ->subject('Nouveauté dans Wild Series')
                ->htmlTemplate('emails/newProgram.html.twig')
                ->context([
                   'program' => $program,
                ]);
            $mailer->send($email);
            return $this->redirectToRoute("program_index");
        }
        return $this->render('program/new.html.twig',['form'=>$form->createView()]);

    }
    /**
     * @Route("/{slug}", name="show")
     * @return Response
     */
    public function show(Program $program):Response
    {

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program->getId() . ' found in program\'s table.'
            );
        }

        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findBy(['program'=>$program]);
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons'=> $seasons,
        ]);
    }
    /**
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();
        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }
    /**
     * @Route("/{program}/seasons/{season}", name="season_show")
     *
     * @return Response A response instance
     */
    public function showSeason(Program $program, Season $season): Response
    {
       return $this->render(
            'program/season_show.html.twig',
            [
                'program' => $program,
                'season' => $season
            ]
        );
    }
    /**
     * @Route("/{program}/seasons/{season_number}/episodes/{episode_number}", name="episode_show")
     * @return Response A response instance
     */
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
       return $this->render(
            'program/episode_show.html.twig',
            [
                'program' => $program,
                'season' => $season,
                'episode' => $episode
            ]
        );
    }
}
