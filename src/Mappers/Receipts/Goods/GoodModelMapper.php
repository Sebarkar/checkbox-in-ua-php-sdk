<?php

namespace Checkbox\Mappers\Receipts\Goods;

use Checkbox\Mappers\Shifts\TaxesMapper;
use Checkbox\Models\Receipts\Goods\GoodModel;

class GoodModelMapper
{
    public function jsonToObject($json): ?GoodModel
    {
        if (is_null($json)) {
            return null;
        }

        $goods = new GoodModel(
            $json['code'],
            $json['price'],
            $json['name'],
            $json['barcode'] ?? '',
            $json['header'] ?? '',
            $json['footer'] ?? '',
            $json['uktzed'] ?? ''
        );

        return $goods;
    }

    public function objectToJson(GoodModel $goodModel)
    {
        return [
            'code' => $goodModel->code,
            'name' => $goodModel->name,
            'barcode' => $goodModel->barcode,
            'header' => $goodModel->header,
            'footer' => $goodModel->footer,
            'price' => $goodModel->price,
            'tax' => (new TaxesMapper())->objectToJson($goodModel->tax)
        ];
    }
}