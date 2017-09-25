<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\FormA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(FormA::class);
        $form->submit([]);

        if ($form->isValid()) {
            die('ok');
        }

        dump($form->getErrors(true, true));die;
    }
}
