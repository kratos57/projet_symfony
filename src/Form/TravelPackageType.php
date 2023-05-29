<?php

namespace App\Form;

use App\Entity\TravelPackage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class TravelPackageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('destination')
            ->add('startDate')
            ->add('endDate')
            ->add('price')
            
            ->add('description')
            ->add('imageFile',VichFileType::class,[
                'label'=>'upload img'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TravelPackage::class,
        ]);
    }
}
