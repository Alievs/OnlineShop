<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController as AdminController;
use Symfony\Component\Routing\Annotation\Route;

class EAdminController extends AdminController
{
    public function changePublishedStatusAction()
    {
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository('App:Product')->find($id);

        $entity->setPublishedAt(!$entity->getPublishedAt() ? new \DateTime(sprintf('-%d days', rand(1, 100))) : null);

        $this->em->flush();

        $this->addFlash('success', sprintf('Product %spublished!', $entity->getPublishedAt() ? '' : 'un'));

        return $this->redirectToRoute('easyadmin', [
            'action' => 'show',
            'entity' => $this->request->query->get('entity'),
            'id' => $id,
        ]);
    }

    public function exportAction()
    {
        throw new \RuntimeException('Action for exporting an entity not defined');
    }

    /**
     * @Route("/dashboard", name="admin_dashboard")
     */
    public function dashboardAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genusRepository = $em->getRepository(Product::class);
        return $this->render('easy_admin/dashboard.html.twig', [
            'genusCount' => $genusRepository->getGenusCount(),
            'publishedGenusCount' => $genusRepository->getPublishedGenusCount(),
            'randomGenus' => $genusRepository->findRandomGenus()
        ]);
    }

}