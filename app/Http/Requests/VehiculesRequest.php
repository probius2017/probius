<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculesRequest extends FormRequest
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
        }else{
            $dateRules = 'required | date';
                $add1 = '| before_or_equal:date_debut';
                $add2 = '| after:date_debut';
        }

        $rules = 
        [   
            //Rules pour les véhicules
            'immat' => 'required | string',
            'old_immat' => 'nullable | string ',
            'pmc' => $dateRules,
            'atp' => $dateRules,
            'modele_id' => 'required | numeric',
            'marque_id' => 'required | numeric',

            //pour la catégeorie
            'category_id' => 'required | numeric',

            //Pour la garantie
            'garantie_id' => 'required | numeric'
        ];

        return $rules;
    }
}
