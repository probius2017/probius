<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocauxRequest extends FormRequest
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
            //Rules pour les locaux
            'ville_local' => 'required | string',
            'cp_local' => 'required | alpha_num',
            'adresse_local' => 'required | string',
            'apptEscalier' => 'required | string',
            'complementGeographique' => 'required | string',
            'superficie' => 'required | numeric',
            'ERP' => 'required | boolean',
            'precaire' => 'required | boolean',
            'nom_bailleur' => 'required | alpha',
            'info_bailleur' => 'required', 
            'loyer' => 'required | numeric', //
            'detail_loyer' => 'required | boolean',
            'pret' => 'required | numeric', //
            'local_partage' => 'required | boolean',
            'precision_partage' => 'required | string',
            'contenu' => 'required | alpha_dash',
            'accessibilite' => 'required | string',
            'observation_generale' => 'required',
            'charge_bailleur' => 'required | string',
            'charge_rdc' => 'required | string',
            'detail_charge' => 'required | string',
            'etat_ini' => 'required |boolean',

            //Rules pour les structures 
            'type_structure' => 'required | array',

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
