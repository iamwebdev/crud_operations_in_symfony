<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PatientRepository;
use App\Entity\Patient;
use App\Entity\User;

class PatientController extends Controller
{
    public function index(PatientRepository $patientRepository)
    {
    	return $this->render('patient/index.html.twig',['patients' => $patientRepository->findAll()]);
    }

    public function new(Request $request)
    {
        $objPatient = new Patient();   
        $userData = $this->getDoctrine()->getRepository(User::class)->findAll();
                   
        $form = $this->createFormBuilder($objPatient)
                    ->add('name',TextType::class)
                    ->add('address',TextType::class)
                    ->add('doctor_id',ChoiceType::class,array('choices' => array('Doctor1' =>1 ,'Doctor2'=> 2)))
                    ->add('save',SubmitType::class,array('label' => 'Add Patient'))
                    ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($objPatient);
            $em->flush();
            return $this->redirectToRoute('/show_all_patient');
        }
            return $this->render('user/create.html.twig', array(
            'form' => $form->createView(),
        ));            
    }
}
