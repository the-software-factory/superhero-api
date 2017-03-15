<?php

namespace AppBundle\Form;

use AppBundle\Model\Superhero;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: lorenzo
 * Date: 14/03/17
 * Time: 10.00
 */
class SuperheroForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
                'label'=> 'Cloak',
            ]
        )->add(
            'birthDate',
            BirthdayType::class,
            [
                'placeholder'=> 'Select one',
            ]
        )->add(
            'avatar',
            UrlType::class
        )->add(
            'Submit',
            SubmitType::class
        );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Superhero::class);
    }
}