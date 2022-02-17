<?php

declare(strict_types=1);

namespace Lipoti\Shop\User\Controller\Registration;

use Doctrine\ORM\EntityManagerInterface;
use Lipoti\Shop\Core\Entity\UserToken;
use Lipoti\Shop\Core\Manager\UserManager;
use Lipoti\Shop\User\Factory\UserTokenFactory;
use Lipoti\Shop\User\Form\RegistrationDto;
use Lipoti\Shop\User\Form\Type\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    private UserManager $userManager;

    private UserTokenFactory $userTokenFactory;

    private EntityManagerInterface $em;

    public function __construct(
        UserManager $userManager,
        UserTokenFactory $userTokenFactory,
        EntityManagerInterface $em
    ) {
        $this->userManager = $userManager;
        $this->userTokenFactory = $userTokenFactory;
        $this->em = $em;
    }

    public function __invoke(Request $request): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('core_home');
        }

        $registrationForm = new RegistrationDto();
        $form = $this->createForm(RegistrationType::class, $registrationForm);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->userManager->create($form->getData());

            $userToken = $this->userTokenFactory->create(UserToken::TYPE_CONFIRM_REGISTRATION, $user);
            $this->em->persist($userToken);
            $this->em->flush();

            return $this->redirectToRoute('user_user_registration_success');
        }

        return $this->render('user/registration/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
