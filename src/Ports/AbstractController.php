<?php

namespace Ports;

use Doctrine\Persistence\ManagerRegistry;
use Lib\Kernel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;
use Symfony\Component\Form\{FormErrorIterator, FormInterface};
use Symfony\Component\HttpFoundation\{Request, RequestStack};
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractController extends SymfonyAbstractController
{
    private readonly ?Request $request;

    public function __construct(
        RequestStack $requestStack,
        protected readonly Kernel $kernel,
        protected readonly ManagerRegistry $doctrine,
        protected readonly MessageBusInterface $bus,
        protected readonly SerializerInterface $serializer,
        protected readonly DenormalizerInterface $denormalizer,
        protected readonly ValidatorInterface $validator
    ) {
        $this->request = $requestStack->getCurrentRequest();
    }

    protected function handle(object $query)
    {
        $envelope = $this->bus->dispatch($query);
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp->getResult();
    }

    /**
     * @param string $message
     */
    protected function flashSuccess(string $message): void
    {
        $this->addFlash('success', $message);
    }

    /**
     * @param FormErrorIterator|string $data
     */
    protected function flashError($data): void
    {
        if ($data instanceof FormErrorIterator) {
            foreach ($data as $message) {
                $this->addFlash('error', $message->getMessage());
            }
        } else {
            $this->addFlash('error', $data);
        }
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
