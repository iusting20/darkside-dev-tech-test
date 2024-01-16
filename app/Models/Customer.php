<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];


    // this function will save the customer data to disk
    public function saveCustomerDataToDisk($customerData)
    {
        try {


            // generate a unique filename
            $filename = $filename ?? uniqid('customer_file_') . '.txt';

            // save the file to the 'customer_files' directory on the 'local' disk
            $fileUploaded = Storage::disk('local')->put('customer_files/' . $filename, $customerData);
            $filePath = Storage::disk('local')->path('customer_files/' . $filename);

            // in case of working on a windows machine file path will look like this:  "D:\folder\file" so we are converting it to this format:  "D:/folder/file"
            $filePath = str_replace('\\', '/', $filePath);

            
            return [
                'msg' => 'Customer data has been saved successfully!', 
                'fileName' => $filename
            ];

        } catch (\Exception $e) {

            // log the error
            return $e;
        }
    }

    // this function will save the customer data to our sqlite database
    public function saveCustomerDataToDatabase($customerData)
    {
        try {

            $customer = new Customer();
            $customer->name = $customerData["name"];
            $customer->email = $customerData["email"];
            $customer->phone = $customerData["phone"];
            $customer->address = $customerData["address"];
            $customer->save();
           
            return [
                'msg' => 'Customer data has been saved successfully in Database!'
            ];

        } catch (\Exception $e) {

            // log the error
            return $e;
        }
    }

}
