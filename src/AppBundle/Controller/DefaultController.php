<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="mainPage")
     * @param $request Request
     * @return RedirectResponse
     */
    public function indexAction(Request $request)
    {

        /* Check Login Status */
        if (($checkLogin = $this->get('app.helper')->checkLogin($request->get('_route'))) !== true) {
            return $checkLogin;
        }

        return new RedirectResponse($this->generateUrl('adminMainPage'), Response::HTTP_TEMPORARY_REDIRECT);
    }

    /**
     * @Route("/admin/main", name="adminMainPage")
     * @param $request Request
     * @return Response
     */
    public function mainAction(Request $request)
    {

        /* Check Login Status */
        if (($checkLogin = $this->get('app.helper')->checkLogin($request->get('_route'))) !== true) {
            return $checkLogin;
        }

        return $this->render(
            ':default:index.html.twig',
            array(
            )
        );
    }
}
