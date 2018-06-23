<?php
/**
 * User: boshurik
 * Date: 23.06.18
 * Time: 22:10
 */

namespace App\Controller;

use Centrifugo\Centrifugo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route(path="/message", name="message")
     *
     * @param Session $session
     * @param Centrifugo $centrifugo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function messageAction(Session $session, Centrifugo $centrifugo, Request $request)
    {
        $centrifugo->broadcast(['chat'], [
            'username' => $session->get('username'),
            'message' => $request->request->get('message'),
        ]);

        return $this->json([]);
    }

    /**
     * @Route(path="/", name="index")
     *
     * @param Centrifugo $centrifugo
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Centrifugo $centrifugo)
    {
        $timestamp = time();
        $token = $centrifugo->generateClientToken('', $timestamp);

        return $this->render('site/index.html.twig', [
            'centrifuge_url' => $this->getParameter('centirgugo_ws'),
            'timestamp' => $timestamp,
            'token' => $token,
        ]);
    }
}