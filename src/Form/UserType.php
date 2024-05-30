<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class,['attr'=>[
                'class'=>'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ',
                'maxlength'=>'50' ,
                'minlength' =>'8'
                ],
                'label'=>'Nom Prénom',
                'label_attr'=>[
                    'class'=> 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
                ],
                'constraints'=>[
                  new Assert\Length(['min'=>8,'max'=>'50']),
                  //new Assert\NotBlank()  
            ]])
            ->add('identifiant',TextType::class,['attr'=>[
                'class'=>'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ',
                'maxlength'=>'50' ,
                'minlength' =>'8'
                ],
                'label'=>'Identifiant',
                'label_attr'=>[
                    'class'=> 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
                ],
                'constraints'=>[
                  new Assert\Length(['min'=>8,'max'=>'50']),
                  //new Assert\NotBlank()  
            ]])
            ->add('email',EmailType::class,['attr'=>[
                'class'=>'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ',
                'maxlength'=>'50' ,
                'minlength' =>'8'
                ],
                'label'=>'Email',
                'label_attr'=>[
                    'class'=> 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
                ],
                'constraints'=>[
                  new Assert\Length(['min'=>8,'max'=>'50']),
                  //new Assert\NotBlank()  
            ]])
            ->add('password',RepeatedType::class,['type'=>PasswordType::class,
            'first_options'=>[
                'attr'=>['class'=>'bg-gray-50 border border-gray-300 text-gray-900 
                sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  '],
                'label'=>'Mot de passe',
                'label_attr'=>[
                    'class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white'],

               
            ],
            'second_options'=>[
                'attr'=>['class'=>'bg-gray-50 border border-gray-300 text-gray-900 
                sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  '],
                'label'=>'Confirmation du mot de passe',
                'label_attr'=>[
                    'class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white'],
                
            ],
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'invalid_message'=>'les mots de passe ne correspondent pas'
        ])
        ->add('submit',SubmitType::class, [
            'attr'=>['class'=>'mt-3 w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800',
             
        ],
        'label'=>'enregistrer'
            
        ]);
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
