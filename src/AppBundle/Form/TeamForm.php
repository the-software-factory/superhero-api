<?php

namespace AppBundle\Form;
use AppBundle\Model\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class TeamForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $option
     */
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder->add(
            'name',
            TextType::class,
            [
                'label' => 'Team Name',           //mi cambia il nome del form, guarda sul path create
            ]
        )->add(
            'hq',
            TextType::class
        )->add(
            'submit',           //per il bottone
            SubmitType::class
        );
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Team::class);
    }
}