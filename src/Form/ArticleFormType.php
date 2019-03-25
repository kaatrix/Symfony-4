<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Article;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use App\Repository\UserRepository;

class ArticleFormType extends AbstractType
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'help' => 'Choose smetihng catchy',
            ])
            ->add('content')
            ->add('publishedAt', null, [
                'widget' => 'single_text'
            ])
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => function(User $user) {
                    return sprintf('(%d) %s', $user->getId(), $user->getEmail());
                },
                'placeholder' => 'Choose an author',
                'choices' => $this->userRepository
                    ->findAllEmailAlphabetical(),
                    'invalid_message' => 'Symfony is too smart for your hacking'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
    }
}