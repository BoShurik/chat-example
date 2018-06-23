<?php
/**
 * User: boshurik
 * Date: 23.06.18
 * Time: 22:10
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route(path="/")
     */
    public function indexAction()
    {
        return $this->render('site/index.html.twig');
    }
}