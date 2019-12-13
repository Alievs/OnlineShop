<?php
/**
 * Created by PhpStorm.
 * User: alibaba
 * Date: 24.10.19
 * Time: 16:20
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('first_name');
        $builder->remove('username');
        $builder->add('last_name');
        $builder->add('agreeTerms', CheckboxType::class, [
                'label' => 'Agree to terms I for sure read',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Please agree to our terms.'
                    ])
                ]
            ]
        );
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}