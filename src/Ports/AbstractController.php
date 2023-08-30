<?php

namespace Ports;

use Lib\Kernel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\{Request, RequestStack};

abstract class AbstractController extends SymfonyAbstractController
{
    private readonly ?Request $request;

    public function __construct(
        RequestStack $requestStack,
        protected readonly Kernel $kernel,
    ) {
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param FormInterface $form
     *
     * @return array
     */
    protected function getFormError(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        return $errors;
    }
}
