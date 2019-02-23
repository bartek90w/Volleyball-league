<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class LuckyController extends AbstractController
{
     /**
      * @Route("/", name="home")
      */
    public function home()
    {
        return $this->render('base.html.twig');
    }

}