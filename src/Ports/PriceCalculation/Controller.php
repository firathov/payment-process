<?php

namespace Ports\PriceCalculation;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Exception;
use Lib\Repository\{CountryTaxesRepository, CouponsRepository, ProductRepository};
use Lib\Service\PriceCalculatorService;
use Ports\AbstractController;
use Ports\PriceCalculation\Form\PriceCalculationForm;
use Symfony\Component\HttpFoundation\{JsonResponse, Request};
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
#[Route(path: '/price-calculation', name: 'price_calculation', methods: ['GET', 'POST'])]
class Controller extends AbstractController
{
    public function __invoke(
        Request $request,
        ProductRepository $productRepository,
        CountryTaxesRepository $countryTaxesRepository,
        CouponsRepository $couponsRepository,
        PriceCalculatorService $priceCalculatorService
    ): JsonResponse {
        $form = $this->createForm(PriceCalculationForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && !$form->isValid()) {
            $message = [];
            foreach ($form->getErrors(true) as $error) {
                $message[] = $error->getMessage();
            }

            return new JsonResponse(['success' => false, 'error' => $message]);
        }

        $data = $form->getData();
        $product = $productRepository->find($data['product']);
        if (!$product) {
            return new JsonResponse(['success' => false, 'error' => 'Product not found']);
        }

        $countryCode = mb_substr($data['taxNumber'], 0, 2);
        $countryTax = $countryTaxesRepository->findOneBy(['country_code' => $countryCode]);
        if (!$countryTax) {
            return new JsonResponse(['success' => false, 'error' => 'Country not found']);
        }

        $coupon = null;
        if ($data['couponCode']) {
            $coupon = $couponsRepository->findOneBy(['couponCode' => $data['couponCode']]);
            if (!$coupon) {
                return new JsonResponse(['success' => false, 'error' => 'Coupon not found']);
            }
        }

        $calculatedPrice = $priceCalculatorService->calculatePrice(
            $product->getPrice(),
            $countryTax->getTax(),
            $coupon ? $coupon->getDiscount() : 0,
            $coupon?->getType()
        );

        return new JsonResponse(['success' => true, 'msg' => ['calculatedPrice' => $calculatedPrice]]);
    }
}
