<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;

class DemoController extends Controller
{
    /**
     * @Route("/demo", name="demo")
     */
    public function index()
    {
        return $this->render('demo/index.html.twig', [
            'controller_name' => 'DemoController',
        ]);
    }

    public function number()
    {
        $number = random_int(0, 100);

        // return new Response(
            // '<html><body>Lucky number: '.$number.'</body></html>'
        // );
        return $this->render('demo/demo.html.twig', array(
            'number' => $number,
        ));
    }

    public function showAll()
    {
    	$product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findAll();
        dd($product);
    }
}
