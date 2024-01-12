<?php

namespace Database\Factories;
use App\Models\Customer;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{

    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */   
    public function definition()
        {
            return [
                'name' => FakerFactory::create()->name,
                'email' => FakerFactory::create()->unique()->safeEmail,
                'phone' => FakerFactory::create()->phoneNumber,
                'address' => FakerFactory::create()->address,
            ];
        }
}

