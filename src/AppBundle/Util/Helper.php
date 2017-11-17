<?php

namespace AppBundle\Util;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class Helper
{


    private $authorizationChecker;
    private $router;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker, Router $router)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->router = $router;

    }


    /**
     * @param $returnTo
     * @return bool|RedirectResponse
     */
    public function checkLogin($returnTo)
    {
        if (!$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY') && !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return new RedirectResponse(
                $this->router->generate('app_login', array(
                    'page' => $returnTo
                )), Response::HTTP_TEMPORARY_REDIRECT);
        }

        return true;
    }


}