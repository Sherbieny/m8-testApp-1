<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('itemDetail1',
                \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                ['label' => false, 'attr' => ['class' => 'form-field']])
            ->add('itemDetail2',
                \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                ['label' => false, 'attr' => ['class' => 'form-field']])
            ->add('itemDetail3',
                \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                ['label' => false, 'attr' => ['class' => 'form-field']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Item'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_item_form_type';
    }
}
