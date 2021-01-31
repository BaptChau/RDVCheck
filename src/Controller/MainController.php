<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use App\Repository\ImportanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CalendarRepository $calendarRepository, ImportanceRepository $importanceRepository): Response
    {
        $rdvs = $calendarRepository->findAll();

        $rdv = [];
        foreach ($rdvs as $events) {
            $bgc = $importanceRepository->findOneBy(['id'=> $events->getImportance()]);
            $rdv[] = [
                'id'=>$events->getId(),
                'start'=>$events->getDebut()->format('Y-m-d H:i:s'),
                'end'=>$events->getFin()->format('Y-m-d H:i:s'),
                'title'=>$events->getTitre(),
                'description'=>$events->getDescription(),
                'backgroundColor'=>$bgc->getColor(),
                'allDay'=>$events->getAllDay(),

            ];
        }
        
        $data = json_encode($rdv);


        return $this->render('main/index.html.twig', compact('data'));
    }
}
