<?php

namespace AppBundle\Controller;

use AppBundle\Form\LoginFormType;
use AppBundle\Form\RegistrationFormType;
use AppBundle\Model\DataObject\User as User;
use Pimcore\Controller\Configuration\TemplatePhp;
use Pimcore\Controller\FrontendController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecureController extends FrontendController
{
    public function loginAction(
        Request $request,
        AuthenticationUtils $authenticationUtils
    ) {
       
		$error = $authenticationUtils->getLastAuthenticationError();
		
		// last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
		 
		$formData = [
            '_username'    => $lastUsername,
            '_target_path' => '/'
        ];
		
		
		
		$form = $this->createForm(LoginFormType::class, $formData, [
            'action' => $this->generateUrl('kb_login'),
        ]);

        return [
            'form'            => $form->createView(),
            'error'           => $error
        ];
    }
	
	public function registerAction(Request $request) {
       
		 
		 $formData = [
            'firstname'    => $request->get('firstname'),
			'lastname'    => $request->get('lastname'),
			'email'    => $request->get('email'),
			'username'    => $request->get('username'),
			'gender'    => $request->get('gender'),
            '_target_path' => '/',
        ];
		
		$form = $this->createForm(RegistrationFormType::class, $formData, [
            'action' => $this->generateUrl('kb_register'),
        ]);
		
		$form->handleRequest($request);

		$formData = $form->getData();
		//print_r($formData);
		if ($form->isSubmitted()) {
			
			$user = new User();
			
			$user->setFirstname($formData['firstname']);
			$user->setLastname($formData['lastname']);
			$user->setEmail($formData['email']);
			$user->setGender($formData['gender']);
			$user->setUsername($formData['username']);
			$user->setPassword($formData['password']);
			
			$user->setKey(\Pimcore\File::getValidFilename($formData['username']));
			$user->setParentId(39);
			$user->SetRoles(['ROLE_USER']);
			$user->save();
			$success = true;
		}	

        return [
            'form'            => $form->createView(),
            'error'           => $error
        ];
    }
    
}
