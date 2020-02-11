<?php

namespace App\Form;

use App\Entity\Classroom;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author EducManagement <educ.management@domain.fr>
 */
final class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Write your firstname here.'
                ]
            ])
            ->add('lastName', TextType::class)
            ->add('birthDate', BirthdayType::class, [
                'input' => 'datetime_immutable',
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => ['Boy' => false, 'Girl' => true]
            ])
            ->add('firstMark', IntegerType::class)
            ->add('secondMark', IntegerType::class)
            ->add('classroom', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Student::class]);
    }
}
