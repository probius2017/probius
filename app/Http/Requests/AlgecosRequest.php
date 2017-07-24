<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlgecosRequest extends FormRequest
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
            //Rules pour les algécos
            'ville_algeco' => 'required | string',
            'cp_algeco' => 'required | alpha_num',
            'adresse_algeco' => 'required | string',
            'apptEscalier' => 'required | string',
            'complementGeographique' => 'required | string',
            'type_algeco' => 'required | string',

            //Rules pour les baux
            'type_document' => 'required | string', 
            'duree_ini' => 'required | numeric',
            'tacite_reconduction' => 'required | boolean',
            'reconduction_description' => 'required | string',
            'description_clause' => 'required | string',
            'quantite_site' => 'required | numeric',
            'date_debut' => $dateRules,
            'date_signature' => $dateRules.$add1,
            'date_fin' => $dateRules.$add2,
        ];

        return $rules;
    }
}