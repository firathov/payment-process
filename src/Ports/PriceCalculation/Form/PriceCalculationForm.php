<?php

namespace Ports\PriceCalculation\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\{AbstractType, FormBuilderInterface};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\{Length, NotBlank, Positive, Regex};

class PriceCalculationForm extends AbstractType
{
    public function getBlockPrefix(): string
    {
        return '';
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', TextType::class, [
                'required' => true,
                'label' => 'Product',
                'constraints' => [
                    new Regex('/^\d+$/', 'This value is not a valid product'),
                    new Positive(['message' => 'product field cannot be less than 1']),
                    new NotBlank(['message' => 'product field is empty']),
                ],
            ])
            ->add('taxNumber', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'taxNumber field is empty']),
                    new Regex([
                        'pattern' => '/^((DE|GR)\d{9})|(IT\d{11})|(FR\w{12})$/',
                        'message' => 'Invalid tax number format.',
                    ]),
                ],
            ])
            ->add('couponCode', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length([
                        'maxMessage' => 'couponCode must not be longer than 5 characters',
                        'max' => 5,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
