<?php


namespace App\Controller;


use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(ProductRepository $repository, CategoryRepository $repositoryCat)
    {

        $products = $repository->findAllPublishedOrderedByNewest();
        $categorys = $repositoryCat->findAll();

        return $this->render('article/shop.html.twig', [
            'products' => $products,
            'categorys' => $categorys,
        ]);
    }

    /**
     * @Route("/category/{name}", name="category_toggle")
     * @ParamConverter("post", options={"name" = "name"})
     */
    public function category(Category $category, ProductRepository $repository, CategoryRepository $repositoryCat)
    {
        $categorys = $repositoryCat->findAll();
        $products = $repository->findAllCategoryOrdered($category);

        return $this->render('article/category.html.twig', [
            'categorys' => $categorys,
            'products' => $products,
        ]);
    }

//    /**
//     * @Route("/category/{slug}", name="product_show")
//     */
//    public function product($slug, EntityManagerInterface $em)
//    {
//        $repository = $em->getRepository(Product::class);
//        $product->getSlug();
//        /**
//         * @var Product $product
//         */
//        $product = $repository->findOneBy(['slug' => $slug]);
//        if (!$product) {
//            throw $this->createNotFoundException(sprintf("No product for slug %s", $slug));
//        }
//        return $this->render('article/product.html.twig', [
//            'product' => $product,
//
//        ]);
//    }

    /**
     * @Route("/new/{id}", name="newfo", methods={"POST", "GET"})
     */

    public function new(Request $request, EntityManagerInterface $em)
    {

        return $this->render('article/new.html.twig', [
        ]);
    }
}

