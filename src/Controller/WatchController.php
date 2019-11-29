<?php

namespace App\Controller;

use App\Entity\Watch;
use App\Form\WatchType;
use App\Repository\WatchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/watch")
 */
class WatchController extends Controller
{
    /**
     * @Route("/", name="watch_index", methods="GET")
     */
    public function index(WatchRepository $watchRepository): Response
    {
        return $this->render('watch/index.html.twig', ['watches' => $watchRepository->findAll()]);
    }

     /**
     * @Route("/new", name="watch_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $watch = new Watch();
        $form = $this->createForm(WatchType::class, $watch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($watch);
            $em->flush();

            return $this->redirectToRoute('watch_index');
        }

        return $this->render('watch/new.html.twig', [
            'watch' => $watch,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="watch_show", methods="GET")
     */
    public function show(Watch $watch): Response
    {
        return $this->render('watch/show.html.twig', ['watch' => $watch]);
    }

    /**
     * @Route("/{id}/edit", name="watch_edit", methods="GET|POST")
     */
    public function edit(Request $request, Watch $watch): Response
    {
        $form = $this->createForm(WatchType::class, $watch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('watch_edit', ['id' => $watch->getId()]);
        }

        return $this->render('watch/edit.html.twig', [
            'watch' => $watch,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="watch_delete", methods="DELETE")
     */
    public function delete(Request $request, Watch $watch): Response
    {
        if ($this->isCsrfTokenValid('delete'.$watch->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($watch);
            $em->flush();
        }

        return $this->redirectToRoute('watch_index');
    }
}
