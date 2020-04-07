<?php

namespace App\Form;

use App\Entity\CardType;
use App\Repository\CardTypeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class CardTypeForm extends AbstractType
{
//    /**
//     * @var CardTypeRepository
//     */
//    private $cardTypeRepository;
//
//    /**
//     * CardTypeForm constructor.
//     * @param CardTypeRepository $cardTypeRepository
//     */
//    public function __construct(CardTypeRepository $cardTypeRepository)
//    {
//        $this->cardTypeRepository = $cardTypeRepository;
//    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [new NotNull() ],
                'required' => true,
            ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            ['data_class' => CardType::class]
        );
    }
}