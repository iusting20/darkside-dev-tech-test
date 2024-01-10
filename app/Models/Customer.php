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


    // this function will save the customer data to disk, just like the tech test brief specified
    public function saveCustomerDataToDisk($fileData)
    {
        try {

            // generate a unique filename
            $filename = $filename ?? uniqid('customer_file_') . '.txt';

            // save the file to the 'customer_files' directory on the 'local' disk
            $filePath = Storage::disk('local')->put('customer_files/' . $filename, $fileData);

            // extra check if customer data has been saved to disk
            if ($filePath) {
                // customer data has been saved successfully
                Log::info('Customer data has been saved successfully');
            } else {
                Log::error('Customer data has not been saved');
            }

        } catch (\Exception $e) {

            // log the error
            return $e;
        }
    }

}
