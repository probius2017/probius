<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SinistresRequest extends FormRequest
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
        if ((strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE)) {
            $dateRules = 'required';
                $add1 = '';
                $add2 = '';
                $add3 = 'nullable';
        }else{
            $dateRules = 'required | date';
                $add1 = '| after_or_equal:date_reception';
                $add2 = '| before_or_equal:date_reception';
                $add3 = 'date | after_or_equal:date_ouverture | nullable';
        }

        $rules = 
        [   
            //Rules pour les sinistres
            'ref_macif' => 'required | numeric',
            'ref_rdc' => 'required | numeric',
            'ville_sinistre' => 'required | string ',
            'date_ouverture' => $dateRules.$add1,
            'date_reception' => $dateRules,
            'date_sinistre' => $dateRules.$add2,
            'responsabilite' => 'required',
            'type_sinistre_id' => 'required | numeric',
            'observation' => 'required | string',
            'reglement_macif' => 'required | numeric', 
            'franchise' => 'required | numeric', 
            'solde_ad' => 'required | numeric', 
            'date_cloture' => $add3,
        ];

        return $rules;
    }
}
