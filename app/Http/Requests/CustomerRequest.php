<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Customer;
use App\Models\Place;


class CustomerRequest  extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'placa' => ['required', 'string', 'max:7','noParking'],
            'document_number' => ['required', 'integer',],
            'place_id' => ['required','exists:places,id','placeAvailable'], 
        ];
    }

    public function withValidator($validator)
    {
        $validator->addExtension('noParking', function ($attribute, $value, $parameters, $validator) {

            return !Customer::where('placa',$value)->where('leaving_date',null)->exists();
        });

        $validator->addReplacer('noParking', function ($message, $attribute, $rule, $parameters, $validator) {
            return __("The Vehicle is in the parking lot.", compact('attribute'));
        });

        $validator->addExtension('placeAvailable', function ($attribute, $value, $parameters, $validator) {

            return Place::where('id',$value)->where('active',true)->exists();
        });

        $validator->addReplacer('placeAvailable', function ($message, $attribute, $rule, $parameters, $validator) {
            return __("The place no is available.", compact('attribute'));
        });



        
    }
}
