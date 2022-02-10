<?php

declare(strict_types=1);

namespace Lipoti\Shop\User\Controller\Registration;

use Doctrine\ORM\EntityManagerInterface;
use Lipoti\Shop\Core\Entity\UserToken;
use Lipoti\Shop\Core\Manager\UserManager;
use Lipoti\Shop\User\Factory\UserTokenFactory;
use Lipoti\Shop\User\Form\RegistrationDto;
use Lipoti\Shop\User\Form\Type\RegistrationType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationController extends AbstractController
{
    private UserManager $userManager;

    private UserTokenFactory $userTokenFactory;

    private MailerInterface $mailer;

    private UrlGeneratorInterface $urlGenerator;

    private EntityManagerInterface $em;

    public function __construct(
        UserManager $userManager,
        UserTokenFactory $userTokenFactory,
        MailerInterface $mailer,
        UrlGeneratorInterface $urlGenerator,
        EntityManagerInterface $em
    ) {
        $this->userManager = $userManager;
        $this->userTokenFactory = $userTokenFactory;
        $this->mailer = $mailer;
        $this->urlGenerator = $urlGenerator;
        $this->em = $em;
    }

    public function __invoke(Request $request): Response
    {
        $registrationForm = new RegistrationDto();
        $form = $this->createForm(RegistrationType::class, $registrationForm);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->userManager->create($form->getData());

            $userToken = $this->userTokenFactory->create(UserToken::TYPE_CONFIRM_REGISTRATION, $user);
            $this->em->persist($userToken);
            $this->em->flush();

            $email = (new TemplatedEmail())
                ->from($this->getParameter('info_email'))
                ->to($user->getEmail())
                ->subject('Confirm email')

                // path of the Twig template to render
                ->htmlTemplate('user/registration/emails/confirm_email.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'url' => $this->urlGenerator->generate('user_user_registration_email_confirm', [
                        'token' => $userToken->getHash(),
                    ], UrlGeneratorInterface::ABSOLUTE_URL),
                ])
            ;
            $this->mailer->send($email);

            return $this->redirectToRoute('user_user_registration_sucsess');
        }

        return $this->render('user/registration/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
