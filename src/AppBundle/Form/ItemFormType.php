<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('itemDetail1', null, ['label' => false, 'attr' => ['class' => 'form-field']])
            ->add('itemDetail2', null, ['label' => false, 'attr' => ['class' => 'form-field']])
            ->add('itemDetail3', null, ['label' => false, 'attr' => ['class' => 'form-field']]);
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
