<?php

/**
 * Created by PhpStorm.
 * User: riccardo
 * Date: 14/03/17
 * Time: 10.01
 */

namespace AppBundle\Form;

use AppBundle\Model\Superhero;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SuperheroForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $option
     */
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder->add(
            'name',
            TextType::class//stesso nome messo nel setter (il setter si chiama setName, quindi Name in minuscolo)
        )->add(
            'realName',
            TextType::class
        )->add(
            'location',
            TextType::class
        )->add(
            'hasCloak',
            CheckboxType::class,
            [
                'label' => 'Cloak',           //mi cambia il nome del form, guarda sul path create
            ]
        )->add(
            'birthDate',
            BirthdayType::class,
            [
                'placeholder' => 'Select one',
            ]
        )->add(
            'avatar',
            TextType::class
        )->add(
            'submit',           //per il bottone
            SubmitType::class
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Superhero::class);
    }
}