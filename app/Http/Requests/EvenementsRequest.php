<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvenementsRequest extends FormRequest
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
                $date = '';
                $add1 = '';
        }else{
                $date = 'date ';
                $add1 = '| after_or_equal:date_demande';
        }

        $rules = 
        [   
            //Rules pour les évènements
            'nom_salle' => 'nullable | string',
            'adresse_event' => 'nullable | string',
            'cp_event' => 'required | alpha_num',
            'ville_event' => 'required | string',
            'nom_event' => 'nullable | string',
            'type_event' => 'required | string',
            'duree_event' => 'numeric',
            'statut_event' => 'boolean',
            'date_demande' => $date,
            'date_reponse' => $date.$add1,
            'remarque' => 'nullable | string'
        ];

        return $rules;
    }
}
