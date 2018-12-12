<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\AcceptCompanyType;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/company")
 */


class CompanyAdminController extends AbstractController
{
    /**
     * @Route("/", name="company_admin", methods="GET|POST" )
     */
    public function index(CompanyRepository $compagnyRepository): Response
    {
        return $this->render('company_admin/index.html.twig', [
            'companies' => $compagnyRepository->findBy([], ['accepted'=>'ASC'])
        ]);
    }

    /**
     * @Route("/{id}", name="company_show", methods="GET|POST")
     */
    public function show(Request $request, Company $company): Response
    {
        $form = $this->createForm(AcceptCompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $company->setAccepted(!$company->getAccepted());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('company_admin', ['id' => $company->getId()]);
        }

        return $this->render('company_admin/show.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="company_admin_delete", methods="DELETE")
     */
    public function delete(Request $request, Company $company): Response
    {
        if ($this->isCsrfTokenValid('delete'.$company->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($company);
            $em->flush();
        }

        return $this->redirectToRoute('company_admin');
    }
}
