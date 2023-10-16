<?php

namespace igorbunov\Checkbox\Mappers\Receipts;

use igorbunov\Checkbox\Mappers\Receipts\Discounts\DiscountsMapper;
use igorbunov\Checkbox\Mappers\Receipts\Goods\GoodsMapper;
use igorbunov\Checkbox\Mappers\Receipts\Payments\PaymentsMapper;
use igorbunov\Checkbox\Models\Receipts\SellReceipt;

class SellReceiptMapper
{
    /**
     * @param SellReceipt $receipt
     * @return array<string, mixed>
     */
    public function objectToJson(SellReceipt $receipt): array
    {
        $delivery = [];

        if ($receipt->deliveryData) {
            foreach ($receipt->deliveryData as $string) {
                if ($string) {
                    $delivery[$this->isEmail($string) ? 'email' : 'phone'] = $string;
                }
            }
        }

        $output = [
            'cashier_name' => $receipt->cashier_name,
            'departament' => $receipt->departament,
            'goods' => (new GoodsMapper())->objectToJson($receipt->goods),
            'delivery' => $delivery,
            'discounts' => (new DiscountsMapper())->objectToJson($receipt->discounts),
            'payments' => (new PaymentsMapper())->objectToJson($receipt->payments),
            'header' => $receipt->header,
            'footer' => $receipt->footer,
            'barcode' => $receipt->barcode
        ];

        if ($receipt->id) {
            $output['id'] = $receipt->id;
        }

        return $output;
    }

    private function isEmail(string $string) {
        return str_contains($string, '@');
    }
}
