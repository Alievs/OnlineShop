<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartLine;
use App\Entity\User;
use App\Form\UserProfileFormType;
use App\Repository\CartLineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/account/show", name="app_account_show")
     */
    public function show()
    {
        $user = $this->getUser();


        return $this->render('account/Profile/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/account/edit", name="app_account_edit")
     */
    public function edit(Request $request, EntityManagerInterface $em)
    {
        $user = $this->getUser();

        $form = $this->createForm(UserProfileFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $em->persist($user);
            $em->flush();

            $this->addFlash('updated', 'User data updated!');
            return $this->redirectToRoute('app_account_edit');
        }

        return $this->render('account/Profile/edit.html.twig', [
            'profileForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/cart", name="app_account_cart")
     */
    public function cart(CartLineRepository $cartLineRepo)
    {

        $cartid = $this->getUser()->getCart()->getId();
        $cartline = $cartLineRepo->findAllCartLineByUser($cartid);


//        $ds = [1,2,[2.1,2.2,2.3],3,[3.1,[3.11,3.12,3.13]]];
//
//        foreach ($ds as $d):
//            if (is_array($d))
//            {
//                foreach ($d as $dd){
//                    if (is_array($dd))
//                    {
//                        foreach ($dd as $ddd){
////                            if (is_array($ddd))
////                            {
////
////                            }
//                            echo "....".$ddd."<br/>";
//                        }
//
//                    }else{
//                        echo '..'.$dd."<br/>";
//                    }
//                }
//            }else{
//                echo $d."<br/>";
//            }
//        endforeach;


        return $this->render('account/Cart/cart.html.twig', [
            'cartlines' => $cartline,
            'cartid' => $cartid,
        ]);
    }

    /**
     * @Route("/account/cart/{cart_id}/{cartline_id}", name="app_cartline_remove", methods={"DELETE"})
     */
    public function delete($cart_id, $cartline_id, EntityManagerInterface $em)
    {

        $cart = $em->getRepository(Cart::class)->find($cart_id);
        if (!$cart) {
            throw $this->createNotFoundException('cart not found');
        }
        $cartlinez = $em->getRepository(CartLine::class)
            ->find($cartline_id);
        if (!$cartlinez) {
            throw $this->createNotFoundException('cartline not found');
        }

        $cart->removeCartLine($cartlinez);
        $em->persist($cart);
        $em->flush();
//        $response = new Response();
//        $response->send();
        return new Response(null, 204);

//        $cartline = $this->getDoctrine()->getRepository(CartLine::class)->find($id);
//
//        $em->remove($cartline);
//        $em->flush();
//
//        $response = new Response();
//        $response->send();
    }


}
