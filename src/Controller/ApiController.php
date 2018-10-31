<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $outputStructure = [
            'screen' => [],
            'deck' => [],
            'slide' => [],
        ];

        // TODO: use custom method in repo to reduce SQL requests
        $screen = $em->getRepository('App:Screen')->find(1);
        $outputStructure['screen'] = [
            'id' => $screen->getId(),
            'name' => $screen->getName(),
            'description' => $screen->getDescription(),
        ];

        foreach ($screen->getScreenHasDecks() as $hasDeck) {
            if ($hasDeck->getEnable() == false)
                continue;

            $deck = $hasDeck->getDeck();
            $outputStructure['deck'][] = [
                'id' => $deck->getId(),
                'name' => $deck->getName(),
                'description' => $deck->getDescription(),
            ];

            foreach($deck->getDeckHasSlides() as $hasSlide) {
                if ($hasSlide->getEnable() == false)
                    continue;

                $slide = $hasSlide->getSlide();
                $outputStructure['slide'][] = [
                    'id' => $slide->getId(),
                    'name' => $slide->getName(),
                    'duration' => $hasSlide->getDuration(),
                ];

            }
        }

        return $this->json($outputStructure);

        dump($outputStructure);
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
