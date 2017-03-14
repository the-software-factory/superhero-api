<?php

/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 14/03/17
 * Time: 10.00
 */

namespace  AppBundle\Form;

use AppBundle\Model\Superhero;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuperheroFrom extends AbstractType //estende questa classe per avere gia i tipi
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //aggiunge le cose in maniera incrementale perche usa il design pattern builder
        $builder->add(
            'name',
            TextType::class
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
                'label' => 'Cloak',
            ]
        )->add(
            'birthDate',
            BirthdayType::class,
            [
                'placeholder' => 'Select one',
            ]
        )->add(
            'submit',
            SubmitType::class
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //questo serve a dire che tipo di oggetto deve aspettarsi di dare dopo l'inserimento del form
        $resolver->setDefault('data_class', Superhero::class);
    }
}