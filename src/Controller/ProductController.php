<?php
/**
 * Created by PhpStorm.
 * User: alibaba
 * Date: 30.01.20
 * Time: 16:34
 */

namespace App\Controller;


use App\Entity\CartLine;
use App\Entity\Product;
use App\Form\QuantityFormType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/category/{name}/{slug}", name="product_show")
     */
    public function product(ProductRepository $repository, $slug, Request $request, EntityManagerInterface $em)
    {
        $product = $repository->findOneBy(['slug' => $slug]);
        /**
         * @var Product $product
         */
        if (!$product) {
            throw $this->createNotFoundException(sprintf("No product for slug %s", $slug));
        }
        $form = $this->createForm(QuantityFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();


            $cartLine = new CartLine();
            $cartLine->setQuantity($form['quantity']->getData());
            $cartLine->addProduct($product);
            $cartLine->setCart($user->getCart());

            $em->persist($cartLine);
            $em->flush();
        }


        return $this->render('article/product.html.twig', [
            'product' => $product,
            'QunatityForm' => $form->createView(),
        ]);
    }

}