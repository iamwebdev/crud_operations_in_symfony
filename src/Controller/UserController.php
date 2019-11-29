<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     */

    # Showing all data from User Table
    public function index()
    {
        $users = $this->getDoctrine()
	        		  ->getRepository(User::class)
	        		  ->findAll();
        return $this->render('user/index.html.twig', compact('users'));
    }

    # Shows Create Form and saves data into User Table
	public function create(Request $request)
    {
        $user = new User;

        #setName,setCity,setOccupation is calling from User model ie User entity

        $user->setName('Type user name'); //Set User-name field with this data "Type user name"
        $user->setCity('write city name');
        $user->setOccupation('write ocuupation name');

        # Create a Form
        
        # Here TextType is input field type that we have to mention as "use Symfony\Component\Form\Extension\Core\Type\TextType" to use

        # ->add('name', TextType::class) here "name" is coming from User Model(Entity) where it is declared as protected

        $form = $this->createFormBuilder($user)
		            ->add('name', TextType::class)
		            ->add('city', TextType::class)
		            ->add('occupation', TextType::class)
		            ->add('save', SubmitType::class, array('label' => 'Add User'))
		            ->getForm();

	 	$form->handleRequest($request);
	 	// dd($form);

	 	#Checks if Form is Submitted or not
	    if ($form->isSubmitted() && $form->isValid()) 
	    {
	        $formData = $form->getData();
	        $entityManager = $this->getDoctrine()->getManager();
	        $entityManager->persist($formData);
	        $entityManager->flush();

	        $this->addFlash(
            'message_sucess',
            'User added successully!'
        	);

	        return $this->redirectToRoute('user');
	       // return $this->render('user/create.html.twig');
	    }    
	    # If form isnot submitted then simply pass view to User for adding new user
        return $this->render('user/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function destroy($id)
    {
    	$entityManager = $this->getDoctrine()->getEntityManager();
	   	$userDetails = $entityManager->getRepository(User::class)->find($id);
   		$entityManager->remove($userDetails);
   		$entityManager->flush(); 
   		return $this->redirectToRoute('user');   
    }

    public function showUser($id) 
    {
	    $entityManager = $this->getDoctrine()->getManager();        
	    $user = $entityManager->getRepository(User::class)->find($id);
	        	// dd($user);
	    if(!$user) 
	    {
	        throw $this->createNotFoundException(
	            'No User found for id '.$id
	        );
	    }

	    return $this->render('User/edit.html.twig', compact('user'));
	}

	public function update(Request $request,$id)
	{
	    $entityManager = $this->getDoctrine()->getManager();
	    $user = $entityManager->getRepository(User::class)->find($id);

	    if (!$user) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$id
	        );
	    }
	    // dd($user);
	    // dd(($request->get('username')));
	    $user->setName($request->get('username'));
		$user->setCity($request->get('cityname'));
		$user->setOccupation($request->get('occupationname'));
		// dd($user->setOccupation);
	    $entityManager->flush();
	    return $this->redirectToRoute('user');
	}

}
