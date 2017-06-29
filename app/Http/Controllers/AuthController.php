<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function authenticate(Request $request)
    {
        //dump($request->all()); die;

    	if( $request->isMethod('post') == true)
	    {
	       	$this->validate($request,[
	          		'login' => 'required|max:255',
	          		'password' => 'required|min:4'
	        ]);
	        
	        $credentials = $request->only('login', 'password');

	        if ($request->remember == 'yes') {
	        	$remember = true;
	        }else{
	           $remember = false;
	        }
	        
	        if(Auth::attempt($credentials, $remember))
	        {
	          //session()->flash('flashMessage', 'Connection réussie');

	           return redirect()->intended('admin/accueil')->withSuccess('Vous êtes connecté(e)');
	           
	        }else{
	          
	          return back()->withInput($request->only('login'))->withErrors('Combinaison login / mot de passe inconnue.'); 
	        }
	    }

      return view('index');
    }


    public function logout()
    {
        auth()->logout(); 

        //session()->flash('flashMessage', 'Vous êtes déconnecté');

        return redirect()->intended('/')->withSuccess('Vous êtes déconnecté(e)');     
    }
}
