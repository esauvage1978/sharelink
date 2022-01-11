<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Link;
use App\Form\Admin\LinkType;
use App\Manager\LinkManager;
use App\Repository\LinkRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class LinkController extends AbstractGController
{
    public function __construct(
        LinkRepository $repository,
        LinkManager $manager
    ) {
        $this->repository = $repository;
        $this->manager = $manager;
        $this->domaine = 'link';
    }

    /**
     * @Route("/admin/link", name="link_list", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function list()
    {
        return $this->listAction();
    }

    /**
     * @Route("/admin/link/add", name="link_add", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function add(Request $request)
    {
        return $this->editAction($request, new link(), linkType::class, false);
    }

    /**
     * @Route("/admin/link/{id}", name="link_del", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, link $item)
    {
        return $this->deleteAction($request, $item);
    }

    /**
     * @Route("/admin/link/{id}", name="link_show", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function show(Request $request, link $item)
    {
        return $this->showAction($request, $item);
    }

    /**
     * @Route("/admin/link/{id}/edit", name="link_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, link $item)
    {
        return $this->editAction($request, $item, linkType::class);
    }


    /**
     * @Route("/link/{id}", name="link_add_click", methods={"GET"})
     */
    public function add_click(link $item)
    {
        $item->setClick($item->getClick() + 1);
        $this->manager->save($item);

        return $this->json([
            'code' => 200,
            'value' => $item->getClick(),
            'message' => 'ok'
        ], 200);
    }

    /**
     * @Route("/ajax/links", name="ajax_links", methods={"POST","GET"})
     *
     * @return Response
     */
    public function ajaxLinks(Request $request, LinkRepository $linkRepository): Response
    {
        $links = $linkRepository->findAllForAjax();

        return $this->json($links);
    }
}
