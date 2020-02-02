<?php
/**
 * Created by PhpStorm.
 * User: alibaba
 * Date: 31.01.20
 * Time: 17:37
 */

namespace App\Form;


use App\Entity\CartLine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class QuantityFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', null, [
                'constraints' => [
                new NotBlank([
                ]),
                    ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CartLine::class,
        ]);
    }

}