<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/screen/{screenId}", name="api_screen")
     */
    public function index(Request $request, EntityManagerInterface $em, int $screenId)
    {
        $outputStructure = [
            'screen' => [],
            'deck' => [],
            'slide' => [],
        ];

        $screen = $em->getRepository('App:Screen')->fetchFullTree($screenId);
        $outputStructure['screen'] = [
            'id' => $screen->getId(),
            'name' => $screen->getName(),
            'description' => $screen->getDescription(),
        ];

        foreach ($screen->getScreenHasDecks() as $hasDeck) {
            $deck = $hasDeck->getDeck();
            $outputStructure['deck'][] = [
                'id' => $deck->getId(),
                'name' => $deck->getName(),
                'description' => $deck->getDescription(),
            ];

            foreach($deck->getDeckHasSlides() as $hasSlide) {
                $slide = $hasSlide->getSlide();
                $outputStructure['slide'][] = [
                    'id' => $slide->getId(),
                    'name' => $slide->getName(),
                    'duration' => $hasSlide->getDuration(),
                ];

            }
        }

        return $this->json($outputStructure);
    }
}
