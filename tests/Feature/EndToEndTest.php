<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EndToEndTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test for sample case.
     *
     * @return void
     */
    public function testSampleCase()
    {
        $response = $this->json('POST', '/taxes', [
            'name' => 'Lucky Stretch',
            'taxCode' => 2,
            'price' => 1000,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'msg' => 'Success create a tax!',
            ]);

        
        $response = $this->json('POST', '/taxes', [
            'name' => 'Big Mac',
            'taxCode' => 1,
            'price' => 1000,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'msg' => 'Success create a tax!',
            ]);
        

        $response = $this->json('POST', '/taxes', [
            'name' => 'Movie',
            'taxCode' => 3,
            'price' => 150,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'msg' => 'Success create a tax!',
            ]);


        $response = $this->get('/taxes');
        $response
            ->assertStatus(200)
            ->assertJson([
                'priceSubtotal' => 2150,
                'taxSubtotal' => 130.50,
                'grandTotal' => 2280.50,
                'taxes' => [
                    [
                        'name' => 'Lucky Stretch',
                        'taxCode' => 2,
                        'type' => 'Tobacco',
                        'refundable' => FALSE,
                        'price' => 1000,
                        'tax' => 30.00,
                        'amount' => 1030.00,
                    ],
                    [
                        'name' => 'Big Mac',
                        'taxCode' => 1,
                        'type' => 'Food & Beverage',
                        'refundable' => TRUE,
                        'price' => 1000,
                        'tax' => 100.00,
                        'amount' => 1100.00,
                    ],
                    [
                        'name' => 'Movie',
                        'taxCode' => 3,
                        'type' => 'Entertainment',
                        'refundable' => FALSE,
                        'price' => 150,
                        'tax' => 0.50,
                        'amount' => 150.50,
                    ],
                ],
            ]);
        return;
    }

    /**
     * Test for sample case with different order.
     *
     * @return void
     */
    public function testSampleCaseWithDifferentOrder()
    {
        $response = $this->json('POST', '/taxes', [
            'name' => 'Movie',
            'taxCode' => 3,
            'price' => 150,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'msg' => 'Success create a tax!',
            ]);


        $response = $this->json('POST', '/taxes', [
            'name' => 'Lucky Stretch',
            'taxCode' => 2,
            'price' => 1000,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'msg' => 'Success create a tax!',
            ]);

        
        $response = $this->json('POST', '/taxes', [
            'name' => 'Big Mac',
            'taxCode' => 1,
            'price' => 1000,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'msg' => 'Success create a tax!',
            ]);


        $response = $this->get('/taxes');
        $response
            ->assertStatus(200)
            ->assertJson([
                'priceSubtotal' => 2150,
                'taxSubtotal' => 130.50,
                'grandTotal' => 2280.50,
                'taxes' => [
                    [
                        'name' => 'Movie',
                        'taxCode' => 3,
                        'type' => 'Entertainment',
                        'refundable' => FALSE,
                        'price' => 150,
                        'tax' => 0.50,
                        'amount' => 150.50,
                    ],
                    [
                        'name' => 'Lucky Stretch',
                        'taxCode' => 2,
                        'type' => 'Tobacco',
                        'refundable' => FALSE,
                        'price' => 1000,
                        'tax' => 30.00,
                        'amount' => 1030.00,
                    ],
                    [
                        'name' => 'Big Mac',
                        'taxCode' => 1,
                        'type' => 'Food & Beverage',
                        'refundable' => TRUE,
                        'price' => 1000,
                        'tax' => 100.00,
                        'amount' => 1100.00,
                    ],
                ],
            ]);
        return;
    }

    /**
     * Test for empty taxes.
     *
     * @return void
     */
    public function testEmptyTaxes()
    {
        $response = $this->get('/taxes');
        $response
            ->assertStatus(200)
            ->assertJson([
                'priceSubtotal' => 0,
                'taxSubtotal' => 0.00,
                'grandTotal' => 0.00,
                'taxes' => [],
            ]);
        return;
    }
}
