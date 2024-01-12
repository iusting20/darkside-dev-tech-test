<?php

namespace Tests\Unit;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase; // Ensure a clean database for each test

    /**
     * Test saving customer data to disk successfully.
     */
    public function test_saveCustomerDataToDisk()
    {
        // set up test data
        $customer = Customer::factory()->create();

        $customerData = json_encode([
            'name' => $customer->name,
            'phone' => $customer->phone,
            'email' => $customer->email,
            'address' => $customer->address,
        ]);


        // actions
        $result = $customer->saveCustomerDataToDisk($customerData);

        // assertions
        $this->assertEquals('Customer data has been saved successfully!', $result['msg']);
        $this->assertFileExists(Storage::disk('local')->path('customer_files/' . $result['fileName']));
        $this->assertEquals($customerData, Storage::disk('local')->get('customer_files/' . $result['fileName']));
    }

}
