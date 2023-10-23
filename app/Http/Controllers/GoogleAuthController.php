<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{


    public function redirect()
    {
        
    return Socialite::driver('google')->redirect();

    }

    public function callbackgoogle(){
       try{
        $google_user = Socialite::driver('google')->user();

        
        $user=User::where('google_id',$google_user->id)->first();
       
        if(!$user){
            $new_user=User::create([
            'name' =>$google_user->getName(),
            'email' =>$google_user->getEmail(),
            'google_id' =>$google_user->id,
            ]);
            Auth::login($new_user); 

           return redirect()->intended('home');
        }
        else{
            Auth::login($user);
            return redirect()->intended('home');
        }
       

           
       }
       catch(Throwable $th){
        dd('something went wrong',$th->getMessage());

       }
       
    }
}
