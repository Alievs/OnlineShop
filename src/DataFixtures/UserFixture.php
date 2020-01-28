<?php
/**
 * Created by PhpStorm.
 * User: alibaba
 * Date: 22.01.20
 * Time: 16:41
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{

    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createSimpleMany(User::class, 10, function(User $user, $count) {

            $user->setEmail(sprintf('easy%d@peasy.com', $count));
            $user->setFirstName($this->faker->firstName);
            $user->agreeTerms();
            $user->setAddress($this->faker->firstName);
            $user->setBalance(rand(1000, 9999));
            $user->setPhoneNumber('+3095847'.rand(1000, 9999));
//            $user->setCart($this->getRandomReference('main_carts'));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));


            return $user;
        });
//
//        $this->createMany(10, 'main_users', function ($i) use ($manager) {
//
//            $user = new User();
//
//            $user->setEmail(sprintf('easy%d@peasy.com', $i));
//            $user->setFirstName($this->faker->firstName);
//            $user->agreeTerms();
//            $user->setAddress($this->faker->address);
//            $user->setBalance(rand(1000, 9999));
//            $user->setPhoneNumber('+3095847'.rand(1000, 9999));
////            $user->setCart($this->getRandomReference('main_carts'));
//            $user->setPassword($this->passwordEncoder->encodePassword(
//                $user,
//                'engage'
//            ));
//
//
//            return $user;
//        });

        $this->createMany(3, 'admin_users', function ($i) {
            $user = new User();
            $user->setEmail(sprintf('adminizy%d@peasy.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setPhoneNumber('+3095847'.rand(1000, 9999));
            $user->setRoles(['ROLE_ADMIN']);
            $user->agreeTerms();

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));

            return $user;
        });

        $this->createMany(1, 'super_admin_users', function ($i) {
            $user = new User();
            $user->setEmail('lol1@gmail.com');
            $user->setFirstName('Leelz');
            $user->setRoles(['ROLE_SUPER_ADMIN']);
            $user->agreeTerms();
            $user->setPhoneNumber('+3095847'.rand(1000, 9999));

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));

            return $user;
        });

        $manager->flush();

    }

}