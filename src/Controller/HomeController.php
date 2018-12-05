<?php

namespace App\Controller;

use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\PartnerController;
use App\Entity\Partner;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PartnerRepository $partnerRepository)
    {
        $partners = $partnerRepository->findAll();
        $nbPartners = count($partners);
        if($nbPartners <= 5){
            $nbSlideToAdd = 6 - $nbPartners;
            for ($i = 0; $i < $nbSlideToAdd ; $i++){
                array_push($partners,$partners[$i+1]);
            }
        }
        return $this->render('home/index.html.twig', ['partners' => $partners]);
    }
}
