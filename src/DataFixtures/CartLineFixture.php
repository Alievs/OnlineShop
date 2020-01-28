<?php
/**
 * Created by PhpStorm.
 * User: alibaba
 * Date: 28.01.20
 * Time: 18:16
 */

namespace App\DataFixtures;


use App\Entity\CartLine;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CartLineFixture extends BaseFixture implements DependentFixtureInterface
{

    protected function loadData(ObjectManager $manager)
    {

        $this->createMany(10, 'main_cart_lines', function($i) {

            $cartLine = new CartLine();
            $cartLine->setQuantity(1);
            $cartLine->setTotalPrice(12);
            $cartLine->setSold(false);
            $cartLine->setCart($this->getRandomReference('main_carts'));


            return $cartLine;
        });

        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            CartFixture::class,
        ];
    }
}