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

        return $this->render('reveal/index.html.twig', [
            'screen' => $screen,
        ]);
    }
}
