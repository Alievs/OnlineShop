<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/account/show", name="app_account_show")
     */
    public function show()
    {
        return $this->render('account/Profile/show.html.twig', [

        ]);
    }

    /**
     * @Route("/account/edit", name="app_account_edit")
     */
    public function edit()
    {
        return $this->render('account/Profile/edit.html.twig', [

        ]);
    }

    /**
     * @Route("/api/account", name="api_account")
     */
    public function accountApi()
    {
        $user = $this->getUser();
        return $this->json($user, 200, [], [
            'groups' => ['main'],
        ]);
    }
}
