<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 05/12/18
 * Time: 11:58
 */

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_form")
     */
    public function sendMail(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            $message = (new \Swift_Message($contactFormData->getSubject()))
                ->setFrom($contactFormData->getMail())
                ->setTo('metierdunumerique@gmail.com')
                ->addReplyTo($contactFormData->getMail())
                ->setBody(
                    'Nouveau message de ' . $contactFormData->getAuthor() .
                    ' :  '  .  "\n" . 'url : ' . $contactFormData->getLink()
                    .  "\n" . 'message : ' .
                    $contactFormData->getMessage()
                );
            $mailer->send($message);
            return $this->redirectToRoute('contact_form');
        }
        return $this->render('contact/indexContact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}