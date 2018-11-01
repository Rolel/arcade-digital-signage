<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RevealController extends AbstractController
{
    /**
     * @Route("/reveal/screen/{screenId}", name="reveal_screen")
     */
    public function index(Request $request, EntityManagerInterface $em, int $screenId)
    {
        $screen = $em->getRepository('App:Screen')->fetchFullTree($screenId);

        // Load top for each slide
        foreach ($screen->getScreenHasDecks() as $hasDeck) {
            $deck = $hasDeck->getDeck();
            foreach($deck->getDeckHasSlides() as $hasSlide) {
                $slide = $hasSlide->getSlide();


                if ($scoreboard = $slide->getScoreboard()) {
                    $slide->top = $em->getRepository('App:Scoreboard')->getTop(
                        $scoreboard->getId(),
                        $slide->getCount(),
                        'value',
                        $slide->getDirection()
                    );
                }

                if ($gametype = $slide->getGametype()) {
                    $scoreboards = $em->getRepository('App:Scoreboard')->getByGameType($gametype);

                    foreach ($scoreboards as $scoreboard) {
                        $slide->top[] = $em->getRepository('App:Scoreboard')->getTop(
                            $scoreboard->getId(),
                            $slide->getCount(),
                            'value',
                            $slide->getDirection()
                        );
                    }
                }



            }
        }

        return $this->render('reveal/index.html.twig', [
            'screen' => $screen,
        ]);
    }
}
