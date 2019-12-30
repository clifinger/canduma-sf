<?php

namespace App\Infra\User\Factory\Form;

use App\Domain\User\Model\User;
use App\Domain\User\ValueObject\UserId;

use App\Infra\Security\ValueObject\EncodedPassword;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Class RegisterType
 *
 * @package App\Infra\User\Factory\Form
 */
class RegisterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('uuid', null, [
                'mapped' => false
            ])
            ->add('email', EmailType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'user.exception.email.not_blank'
                    ]),
                    new NotNull([
                        'message' => 'user.exception.null.not_null'
                    ]),
                    new Email([
                        'message' => 'user.exception.email.not_valid'
                    ])
                ]
            ])
            ->add('username', TextType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'user.exception.username.not_blank'
                    ]),
                    new NotNull([
                        'message' => 'user.exception.username.not_null'
                    ])
                ]
            ])
            ->add('password', PasswordType::class, [
                'mapped' => false
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
            'empty_data' => function (FormInterface $form) {

                return User::create(
                    $form->get('uuid')->getData(),
                    (string) $form->get('username')->getData(),
                    (string) $form->get('email')->getData(),
                    new EncodedPassword((string) $form->get('password')->getData())
                );
            }
        ]);
    }
}
