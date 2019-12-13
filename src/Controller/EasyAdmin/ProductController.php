<?php


namespace App\Controller\EasyAdmin;


use App\Entity\Product;
use App\Service\CsvExporter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends EAdminController
{

    /**
     * @var CsvExporter
     */
    private $csvExporter;

    public function __construct(CsvExporter $csvExporter)
    {
        $this->csvExporter = $csvExporter;
    }

    /**
     * @Route("/product/feed", name="product_feed")
     */
    public function feedAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $id = $request->query->get('id');
        $user = $em->getRepository('App:Product')->find($id);

        $menu = ['shrimp', 'clams', 'lobsters', 'dolphin'];
        $meal = $menu[random_int(0, 3)];

        $this->addFlash('info', $user->feed([$meal]));

        return $this->redirectToRoute('easyadmin', [
            'action' => 'show',
            'entity' => $request->query->get('entity'),
            'id' => $id
        ]);

    }

    public function exportAction()
    {
        $sortDirection = $this->request->query->get('sortDirection');
        if (empty($sortDirection) || !in_array(strtoupper($sortDirection), ['ASC', 'DESC'])) {
            $sortDirection = 'DESC';
        }

        $queryBuilder = $this->createListQueryBuilder(
            $this->entity['class'],
            $sortDirection,
            $this->request->query->get('sortField'),
            $this->entity['list']['dql_filter']
        );

        return $this->csvExporter->getResponseFromQueryBuilder(
            $queryBuilder,
            Product::class,
            'product.csv'
        );
    }

}