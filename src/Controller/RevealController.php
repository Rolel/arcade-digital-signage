<?php

namespace App\Controller;

use App\Repository\ScreenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RevealController extends AbstractController
{
    /**
     * @Route("/", name="reveal_screenlist")
     */
    public function indexAction(ScreenRepository $screenRepository)
    {
        return $this->render('reveal/index.html.twig', [
            'screens' => $screenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/reveal/screen/{screenId}", name="reveal_screen")
     */
    public function screenAction(Request $request, EntityManagerInterface $em, int $screenId)
    {
        $screen = $em->getRepository('App:Screen')->fetchFullTree($screenId);

        // Load top for each slide
        foreach ($screen->getScreenHasDecks() as $hasDeck) {
            $deck = $hasDeck->getDeck();
            foreach($deck->getDeckHasSlides() as $hasSlide) {
                $slide = $hasSlide->getSlide();

                if ($scoreboard = $slide->getScoreboard()) {
                    $top = $em->getRepository('App:Score')->getTop(
                        $scoreboard->getId(),
                        $slide->getCount(),
                        'value',
                        $slide->getDirection()
                    );
                    $slide->top = [
                        'scoreboard' => $scoreboard,
                        'scores' => $top
                    ];
                }

                if ($gametype = $slide->getGametype()) {
                    $scoreboards = $em->getRepository('App:Scoreboard')->getByGameType($gametype);

                    $slide->top = [];
                    foreach ($scoreboards as $scoreboard) {
                        $top = $em->getRepository('App:Score')->getTop(
                            $scoreboard->getId(),
                            $slide->getCount(),
                            'value',
                            $slide->getDirection()
                        );
                        $slide->top[] = [
                            'scoreboard' => $scoreboard,
                            'scores' => $top
                        ];
                    }
                }
            }
        }

        return $this->render('reveal/screen.html.twig', [
            'screen' => $screen,
        ]);
    }
}
