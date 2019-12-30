<?php

namespace App\Infra\Common\Factory;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

use App\Infra\Common\Exception\Form\FormException;
use App\Infra\Common\Exception\Form\FormFactoryException;

/**
 * Class AbstractFactory
 *
 * @package App\Infra\Common\Factory
 */
abstract class AbstractFactory
{
    const
        CREATE = 'POST',
        REPLACE = 'PUT',
        UPDATE = 'PATCH'
    ;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var string
     */
    protected $formClass;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
        
        if (!$this->formClass) {
            
            throw new FormFactoryException();
        }
    }

    /**
     * @param string $action
     * @param array $data
     * @param null|object $object
     *
     * @return mixed
     *
     * @throws FormException
     */
    protected function execute(string $action = self::CREATE, array $data, $object = null)
    {
        $form = $this->createForm($action, $object)->submit($data, self::UPDATE !== $action);

        if (!$form->isValid()) {

            throw new FormException($form);
        }

        $this->setTimestamp($action, $object);

        return $form->getData();
    }

    private function setTimestamp(string $action, $object): void
    {
        if (is_object($object)
            && in_array($action, [ self::UPDATE, self::REPLACE ])
            && method_exists($object, 'setUpdate')
        ) {

            $object->setUpdate(new \DateTimeImmutable());
        }
    }

    private function createForm(string $action = self::CREATE, $object = null): FormInterface
    {
        return $this->formFactory->create($this->formClass, $object, [
            'method' => $action
        ]);
    }
}
