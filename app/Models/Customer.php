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
            
            return 'Customer data has been saved successfully!';

        } catch (\Exception $e) {

            // log the error
            return $e;
        }
    }

}
