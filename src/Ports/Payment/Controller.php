<?php

namespace Ports\Payment;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Exception;
use Lib\Kernel;
use Lib\Repository\ProductRepository;
use Ports\AbstractController;
use Ports\Payment\Form\PaymentForm;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, RequestStack, Response};
use Symfony\Component\Routing\Annotation\Route;

/**
 * @param Request $request
 *
 * @throws ORMException
 * @throws OptimisticLockException
 * @throws Exception
 *
 * @return JsonResponse
 */
#[Route(path: '/payment-process', name: 'payment_process', methods: ['GET', 'POST'])]
class Controller extends AbstractController
{
    public function __construct(
        RequestStack $requestStack,
        Kernel $kernel,
        private readonly iterable $paymentProcessors
    ) {
        parent::__construct($requestStack, $kernel);
    }

    public function __invoke(
        Request $request,
        ProductRepository $productRepository
    ): Response {
        $form = $this->createForm(PaymentForm::class);
        if ($request->getContentTypeFormat() === 'json') {
            $jsonData = json_decode($request->getContent(), true);
            $form->submit($jsonData);
        } else {
            $form->handleRequest($request);
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $message = [];
            foreach ($form->getErrors(true) as $error) {
                $message[] = $error->getMessage();
            }

            return new JsonResponse(['success' => false, 'error' => $message], Response::HTTP_BAD_REQUEST);
        }

        $data = $form->getData();
        $product = $productRepository->find($data['product']);

        if (!isset($this->paymentProcessors[$data['paymentProcessor']])) {
            return new JsonResponse(['error' => 'Invalid payment processor'], Response::HTTP_BAD_REQUEST);
        }

        $paymentProcessor = $this->paymentProcessors[$data['paymentProcessor']];

        $paymentSuccess = $paymentProcessor->processPayment($product->getPrice());

        if ($paymentSuccess) {
            return new JsonResponse(['success' => true, 'message' => 'Payment Success'], Response::HTTP_OK);
        } else {
            return new JsonResponse(['error' => 'Payment failed'], Response::HTTP_BAD_REQUEST);
        }
    }
}
