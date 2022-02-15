<?php

declare(strict_types=1);

namespace Lipoti\Shop\User\Controller\Registration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegistrationSuccessController extends AbstractController
{
    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function __invoke()
    {
        return $this->render('user/registration/registration_success.html.twig');
    }
}
