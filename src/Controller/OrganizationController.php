<?php

namespace App\Controller;

use App\Form\OrganizationType;
use App\Services\OrganizationManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/organization")
 */
class OrganizationController extends AbstractController
{
    /**
     * @Route("/", name="organization")
     */
    public function index(Request $request, OrganizationManager $organizationManager)
    {

        $organizations = $organizationManager->getOrganizations();

        $addOrgForm = $this->createForm(OrganizationType::class);

        $addOrgForm->handleRequest($request);

        if ($addOrgForm->isSubmitted() && $addOrgForm->isValid()) {
            $organization = $addOrgForm->getData();
            $organizationManager->addOrganization($organization);

            $this->addFlash('success', 'Organization added successfully');

            return $this->redirectToRoute('organization');
        }

        return $this->render('organization/index.html.twig', [
            'organizations' => $organizations,
            'form' => $addOrgForm->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_organization")
     */
    public function edit(Request $request, OrganizationManager $organizationManager, $id)
    {
        $organization = $organizationManager->getOrganization($id);
        $editOrgForm = $this->createForm(OrganizationType::class, $organization);
        $editOrgForm->handleRequest($request);

        if ($editOrgForm->isSubmitted() && $editOrgForm->isValid()) {
            $organization = $editOrgForm->getData();
            $organizationManager->editOrganization($id, $organization);

            $this->addFlash('success', 'Organization edited successfully');

            return $this->redirectToRoute('organization');
        }

        return $this->render('organization/edit.html.twig', [
            'form' => $editOrgForm->createView(),
            'organization' => $organization,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_organization")
     */
    public function delete(OrganizationManager $organizationManager, $id)
    {
        $organizationManager->removeOrganization($id);

        $this->addFlash('success', 'Organization deleted successfully');
        return $this->redirectToRoute('organization');
    }
}
