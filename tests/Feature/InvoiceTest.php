<?php

namespace Tests\Feature;

use Tests\TestCase;

class InvoiceTest extends TestCase
{
    public function test_invoice_create_page_can_be_rendered(): void
    {
        $response = $this->get('/invoice/create');

        $response->assertStatus(200);
    }
}
