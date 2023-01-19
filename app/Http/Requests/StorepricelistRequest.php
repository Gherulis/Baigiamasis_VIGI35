<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorepricelistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

                'saltas_vanduo' => 'required|integer',
                'karstas_vanduo' => 'required|integer',
                 'sildymas' => 'required|integer',
                'silumos_mazg_prieziura' => 'required|integer',
                 'gyvatukas' => 'required|integer',
                'salto_vandens_abon' =>'required|integer',
                 'elektra_bendra' => 'required|integer',
                'ukio_islaid' =>'required|integer',
                 'nkf' => 'required|integer',

        ];
    }
}
