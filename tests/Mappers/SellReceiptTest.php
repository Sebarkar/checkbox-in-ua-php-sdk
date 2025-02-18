<?php

declare(strict_types=1);

namespace igorbunov\Checkbox\Mappers;

use igorbunov\Checkbox\Mappers\Receipts\ReceiptMapper;
use igorbunov\Checkbox\Mappers\Receipts\SellReceiptMapper;
use igorbunov\Checkbox\Mappers\Receipts\Taxes\GoodTaxMapper;
use igorbunov\Checkbox\Models\Receipts\Goods\GoodItemModel;
use igorbunov\Checkbox\Models\Receipts\Goods\GoodModel;
use igorbunov\Checkbox\Models\Receipts\Goods\Goods;
use igorbunov\Checkbox\Models\Receipts\Payments\CardPaymentPayload;
use igorbunov\Checkbox\Models\Receipts\Payments\CashPaymentPayload;
use igorbunov\Checkbox\Models\Receipts\Payments\Payments;
use igorbunov\Checkbox\Models\Receipts\SellReceipt;
use igorbunov\Checkbox\Models\Receipts\Taxes\GoodTaxes;
use PHPUnit\Framework\TestCase;

class SellReceiptTest extends TestCase
{
    /** @var  string $jsonString */
    private $jsonString;
    /** @var  string $mappedJsonString */
    private $mappedJsonString;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->mappedJsonString = '{"cashier_name":"\u0412\u0430\u0441\u044f \u041f\u0443\u043f\u043a\u0438\u04' .
            '3d","departament":"\u041e\u0442\u0434\u0435\u043b \u043f\u0440\u043e\u0434\u0430\u0436","good' .
            's":[{"good":{"code":"vm-123","name":"\u0411\u0438\u043e\u0432\u0430\u043a","barcode":"","head' .
            'er":"","footer":"","price":5000,"tax":["123123"],"uktzed":""},"quantity":1000,"is_return":false,' .
            '"discounts":[]},{"good":{"code":"vm-124","name":"\u0411\u0438\u043e\u0432\u0430\u043a 2",' .
            '"barcode":"","header":"","footer":"","price":2000,"tax":["123123"],"uktzed":""},' .
            '"quantity":2000,"is_return":false,"discounts":[]}],"delivery":{"email":"admin@gmail.com"},' .
            '"discounts":[],"payments":[{"type":"CASHLESS","value":"4000","la' .
            'bel":"\u0411\u0435\u0437\u0433\u043e\u0442\u0456\u0432\u043a\u043e\u0432\u0438\u0439"},{"ty' .
            'pe":"CASH","value":"5000","label":"\u0413\u043e\u0442\u0456\u0432\u043a\u043e\u044e"}],"head' .
            'er":"","footer":"","barcode":""}';

        $this->jsonString = '{
           "id":"c4d4c3e2-a3a5-4d13-b7a9-1516dddd21a1",
           "type":"SELL",
           "transaction":{
              "id":"6b24c197-aa7c-4131-ab7f-0a08a3886447",
              "type":"RECEIPT",
              "serial":4,
              "status":"PENDING",
              "request_signed_at":null,
              "request_received_at":null,
              "response_status":null,
              "response_error_message":null,
              "created_at":"2020-11-09T08:21:02.362586+00:00",
              "updated_at":"2020-11-09T08:21:02.489825+00:00"
           },
           "serial":73,
           "status":"CREATED",
           "goods":[
              {
                 "good":{
                    "code":"vm-123",
                    "barcode":"",
                    "name":"Биовак",
                    "header":"",
                    "footer":"",
                    "uktzed":null,
                    "price":5000
                 },
                 "good_id":null,
                 "sum":5000,
                 "quantity":1000,
                 "is_return":false,
                 "taxes":[

                 ],
                 "discounts":[

                 ]
              },
              {
                 "good":{
                    "code":"vm-124",
                    "barcode":"",
                    "name":"Биовак 2",
                    "header":"",
                    "footer":"",
                    "uktzed":null,
                    "price":2000
                 },
                 "good_id":null,
                 "sum":4000,
                 "quantity":2000,
                 "is_return":false,
                 "taxes":[

                 ],
                 "discounts":[

                 ]
              }
           ],
           "payments":[
              {
                 "type":"CASHLESS",
                 "code":null,
                 "value":"4000",
                 "label":"Безготівковий",
                 "card_mask":"0000 **** **** 0000"
              },
              {
                 "type":"CASH",
                 "value":"5000",
                 "label":"Готівкою"
              }
           ],
           "sum":9000,
           "total_payment":9000,
           "rest":0,
           "fiscal_code":"74rElN8f1DI",
           "fiscal_date":"2020-11-09T08:21:02.362586+00:00",
           "delivered_at":null,
           "created_at":"2020-11-09T08:21:02.362586+00:00",
           "updated_at":"2020-11-09T08:21:02.434213+00:00",
           "taxes":[

           ],
           "discounts":[

           ],
           "header":"",
           "footer":"",
           "barcode":"",
           "is_created_offline":true,
           "is_sent_dps":false,
           "sent_dps_at":null,
           "shift":{
              "id":"803010a9-2778-4a37-99ef-1e2e8402abc6",
              "serial":29,
              "status":"OPENED",
              "z_report":null,
              "opened_at":"2020-11-09T07:50:43.585236+00:00",
              "closed_at":null,
              "initial_transaction":{
                 "id":"6def56ef-b6b7-4873-b4e8-599ffd8012cf",
                 "type":"SHIFT_OPEN",
                 "serial":0,
                 "status":"DONE",
                 "request_signed_at":"2020-11-09T07:50:42.439730+00:00",
                 "request_received_at":null,
                 "response_status":null,
                 "response_error_message":null,
                 "created_at":"2020-11-09T07:50:41.433615+00:00",
                 "updated_at":"2020-11-09T07:50:43.572204+00:00"
              },
              "closing_transaction":null,
              "created_at":"2020-11-09T07:50:41.433615+00:00",
              "updated_at":"2020-11-09T07:50:43.585236+00:00",
              "balance":{
                 "initial":271230,
                 "balance":296730,
                 "cash_sales":0,
                 "card_sales":0,
                 "cash_returns":0,
                 "card_returns":0,
                 "service_in":25500,
                 "service_out":0,
                 "updated_at":"2020-11-09T07:53:22.946890+00:00"
              },
              "taxes":[
                 {
                    "id":"21e77e08-e70c-441a-8e54-c5f6fcb5a997",
                    "code":1234567891,
                    "label":"Побори",
                    "symbol":"Я",
                    "rate":12,
                    "extra_rate":15,
                    "included":true,
                    "created_at":"2020-10-22T15:42:36+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 },
                 {
                    "id":"3970535c-7535-4788-a58d-214c88a1d9a0",
                    "code":1234567890,
                    "label":"ПДВ",
                    "symbol":"A",
                    "rate":5,
                    "extra_rate":null,
                    "included":true,
                    "created_at":"2020-10-07T11:22:07+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 },
                 {
                    "id":"71b1ed5b-40df-4ef7-a8bc-0b63c61b01ef",
                    "code":123123,
                    "label":"4",
                    "symbol":"Д",
                    "rate":5,
                    "extra_rate":null,
                    "included":true,
                    "created_at":"2020-10-22T16:14:11+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 },
                 {
                    "id":"5fd9b28f-7954-4db3-bf3f-434fb5fd75e9",
                    "code":4,
                    "label":"ПДВ",
                    "symbol":"В",
                    "rate":7,
                    "extra_rate":0,
                    "included":true,
                    "created_at":"2020-10-26T10:53:33+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 },
                 {
                    "id":"a8ef8480-0ea9-46b3-8307-84761a747152",
                    "code":2,
                    "label":"Акцизний збір",
                    "symbol":"Г",
                    "rate":0,
                    "extra_rate":5,
                    "included":true,
                    "created_at":"2020-10-26T10:53:41+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 },
                 {
                    "id":"75faedfe-c446-4596-9f91-dd956081f2a9",
                    "code":3,
                    "label":"Без ПДВ",
                    "symbol":"Е",
                    "rate":0,
                    "extra_rate":0,
                    "included":true,
                    "created_at":"2020-10-26T10:54:08+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 },
                 {
                    "id":"9619335b-ad11-421a-a5c9-7744ff95aaf6",
                    "code":1,
                    "label":"ПДВ А",
                    "symbol":"Є",
                    "rate":20,
                    "extra_rate":0,
                    "included":true,
                    "created_at":"2020-10-26T10:54:18+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 },
                 {
                    "id":"d1f2388b-e407-47a7-a818-84d86f799315",
                    "code":5,
                    "label":"Не є об\'єктом оподаткування",
                    "symbol":"И",
                    "rate":0,
                    "extra_rate":0,
                    "included":true,
                    "created_at":"2020-10-26T10:54:47+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 },
                 {
                    "id":"6cbc33db-7bbc-488e-9cad-36d25ed09889",
                    "code":1230321,
                    "label":"Без ПДВ",
                    "symbol":"Б",
                    "rate":0,
                    "extra_rate":3,
                    "included":true,
                    "created_at":"2020-10-08T16:22:21+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 },
                 {
                    "id":"d964bc15-9815-42ef-b975-a487de89a804",
                    "code":123124,
                    "label":"1",
                    "symbol":"Ж",
                    "rate":1,
                    "extra_rate":1,
                    "included":true,
                    "created_at":"2020-10-08T16:24:47+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 },
                 {
                    "id":"724c5147-2ff0-45e7-8adc-a22dd7a55a09",
                    "code":33333,
                    "label":"2",
                    "symbol":"З",
                    "rate":1,
                    "extra_rate":6,
                    "included":true,
                    "created_at":"2020-10-08T16:25:03+00:00",
                    "updated_at":null,
                    "sales":0,
                    "returns":0,
                    "sales_turnover":0,
                    "returns_turnover":0
                 }
              ],
              "cash_register":{
                 "id":"3e650f3e-09b9-44e4-baea-f40f143cbb00",
                 "fiscal_number":"4000037367",
                 "created_at":"2020-09-28T10:57:51+00:00",
                 "updated_at":"2020-11-09T08:21:02.489825+00:00"
              },
              "cashier":{
                 "id":"b24a5d01-9660-4269-baf9-ffda938c8f56",
                 "full_name":"usertestkey 82",
                 "nin":"",
                 "key_id":"f8d4d9a394699c44616a8d84250f2cdc08331007d915f652e436b94e067643ed",
                 "signature_type":"AGENT",
                 "created_at":"2020-09-29T11:38:55+00:00",
                 "updated_at":"2020-09-29T11:52:36+00:00"
              }
           }
        }';
    }

    public function testMap(): void
    {
        $goodTaxJson = '{
        "id": "8a18b9d2-2ecf-4979-9aef-655553b4c644",
        "code": 123123,
        "label": "4",
        "symbol": "Д",
        "rate": 1,
        "extra_rate": null,
        "included": true,
        "created_at": "2020-08-14T13:32:07+00:00",
        "updated_at": "2020-10-22T16:14:11+00:00"
    }';
        $goodTaxJson = \json_decode($goodTaxJson, true);

        $goodTax = (new GoodTaxMapper())->jsonToObject($goodTaxJson);
        $goodTaxes = new GoodTaxes([$goodTax]);

        $receipt = new SellReceipt(
            'Вася Пупкин',
            'Отдел продаж',
            new Goods(
                [
                    new GoodItemModel(
                        new GoodModel(
                            'vm-123', // good_id
                            50 * 100, // 50 грн
                            'Биовак',
                            '',
                            '',
                            '',
                            '',
                            $goodTaxes
                        ),
                        1 * 1000
                    ),
                    new GoodItemModel(
                        new GoodModel(
                            'vm-124', // good_id
                            20 * 100, // 20 грн
                            'Биовак 2',
                            '',
                            '',
                            '',
                            '',
                            $goodTaxes
                        ),
                        2 * 1000 // 2 шт
                    )
                ]
            ),
            'admin@gmail.com',
            new Payments([
                new CardPaymentPayload(
                    "4000" // 40 грн
                ),
                new CashPaymentPayload(
                    "5000" // 50 грн
                )
            ]),
        );

        $result = \json_encode((new SellReceiptMapper())->objectToJson($receipt));

        $this->assertEquals($this->mappedJsonString, $result);
    }

    public function testMapWithId()
    {
        $goodTaxJson = '{
        "id": "8a18b9d2-2ecf-4979-9aef-655553b4c644",
        "code": 123123,
        "label": "4",
        "symbol": "Д",
        "rate": 1,
        "extra_rate": null,
        "included": true,
        "created_at": "2020-08-14T13:32:07+00:00",
        "updated_at": "2020-10-22T16:14:11+00:00"
    }';
        $goodTaxJson = \json_decode($goodTaxJson, true);

        $goodTax = (new GoodTaxMapper())->jsonToObject($goodTaxJson);
        $goodTaxes = new GoodTaxes([$goodTax]);

        $receipt = new SellReceipt(
            'Вася Пупкин',
            'Отдел продаж',
            new Goods(
                [
                    new GoodItemModel(
                        new GoodModel(
                            'vm-123', // good_id
                            50 * 100, // 50 грн
                            'Биовак',
                            '',
                            '',
                            '',
                            '',
                            $goodTaxes
                        ),
                        1 * 1000
                    ),
                    new GoodItemModel(
                        new GoodModel(
                            'vm-124', // good_id
                            20 * 100, // 20 грн
                            'Биовак 2',
                            '',
                            '',
                            '',
                            '',
                            $goodTaxes
                        ),
                        2 * 1000 // 2 шт
                    )
                ]
            ),
            'admin@gmail.com',
            new Payments([
                new CardPaymentPayload(
                    "4000" // 40 грн
                ),
                new CashPaymentPayload(
                    "5000" // 50 грн
                )
            ]),
            null,
            '',
            '',
            '',
            'test-source-id'
        );

        $result = \json_encode((new SellReceiptMapper())->objectToJson($receipt));

        $mappedJsonString = json_decode($this->mappedJsonString, true);
        $mappedJsonString['id'] = 'test-source-id';

        $this->assertEquals(json_encode($mappedJsonString), $result);
    }

    public function testMapReceiptReuslt()
    {
        $jsonResponse = json_decode($this->jsonString, true);

        $mapped = (new ReceiptMapper())->jsonToObject($jsonResponse);

        $this->assertEquals(
            'c4d4c3e2-a3a5-4d13-b7a9-1516dddd21a1',
            $mapped->id
        );
        $this->assertEquals(
            '6b24c197-aa7c-4131-ab7f-0a08a3886447',
            $mapped->transaction->id
        );
        $this->assertEquals(
            1000,
            $mapped->goods->results[0]->quantity
        );
        $this->assertEquals(
            '4000',
            $mapped->payments->results[0]->value
        );
        $this->assertEquals(
            '803010a9-2778-4a37-99ef-1e2e8402abc6',
            $mapped->shift->id
        );
        $this->assertEquals(
            '6def56ef-b6b7-4873-b4e8-599ffd8012cf',
            $mapped->shift->initial_transaction->id
        );
        $this->assertEquals(
            '296730',
            $mapped->shift->balance->balance
        );
        $this->assertEquals(
            '21e77e08-e70c-441a-8e54-c5f6fcb5a997',
            $mapped->shift->taxes->taxes[0]->id
        );
        $this->assertEquals(
            'b24a5d01-9660-4269-baf9-ffda938c8f56',
            $mapped->shift->cashier->id
        );
    }
}
