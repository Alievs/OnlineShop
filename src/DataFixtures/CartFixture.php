<?php
/**
 * Created by PhpStorm.
 * User: alibaba
 * Date: 22.01.20
 * Time: 18:11
 */

namespace App\DataFixtures;


use App\Entity\Cart;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CartFixture extends BaseFixture implements DependentFixtureInterface
{

    protected function loadData(ObjectManager $manager)
    {
//        $this->createSimpleMany(Cart::class, 10, function(Cart $cart, $count) {
//
//            $cart->setQuantity(1);
//            $cart->setTotalPrice(12);
//            $cart->setSold(false);
//            $cart->setUser($this->getReference(User::class.'_'.$count));//$this->faker->numberBetween(0, 9)
//
//
//            return $cart;
//        });

        $this->createMany(10, 'main_carts', function($i) use ($manager) {

            $cart = new Cart();
            $cart->setUser($this->getReference(User::class.'_'.$i));


            return $cart;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixture::class,
        ];
    }

}