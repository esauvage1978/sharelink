<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\LinkRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HomeController extends AbstractGController
{
    /**
     * @Route("/", name="home")
     */
    public function index(LinkRepository $linkRepository)
    {
        $links=$linkRepository->findAllForShow();
        return $this->render('home/index.html.twig',['items'=>$links]);
    }


}
