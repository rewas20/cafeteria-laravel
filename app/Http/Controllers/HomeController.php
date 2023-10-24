<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Policies\UserPolicy;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //check verification email with middleware verified or not 
        $this->middleware(['auth','verified'])->only(['choose']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     
     public function index()
     {
        
        $userAdded ="";
        $isUser = Gate::inspect('user',Auth::user());
        if($isUser->allowed()){
            $userAdded = Auth::user(); 
            session()->pull('user');
            session()->put('user',$userAdded);

        }


         $products = Product::where('status','available')->orderBy('id', 'DESC')->paginate(10);
         $users = User::where('role', 'user')->get();
        
         return view('home.index', ['products' => $products, 'users' => $users,'userAdded'=>$userAdded]);
     }

     public function search(Request $request){
        $search = $request->input('search');
        $products = Product::where('name','LIKE', '%'.$search.'%')->paginate(5);
        $users = User::where('role', 'user')->get();

        $userAdded = "";
        $isUser = Gate::inspect('user',Auth::user());
        if($isUser->allowed()){
            $userAdded = Auth::user(); 
            session()->pull('user');
            session()->put('user',$userAdded);
        }

        return view('home.index',['products' => $products, 'users' => $users,'userAdded'=>$userAdded]);

   

    }

    public function choose(Request $request){
        $isAdmin = Gate::inspect('admin',Auth::user());
        if($isAdmin->allowed()){
            $userAdded = $request->user?? $request->user;
            session()->pull('user');
            if($userAdded){
                $userAdded = User::find($userAdded);
                session()->put('user',$userAdded);
                
            }
            $products = Product::where('status','available')->orderBy('id', 'DESC')->paginate(10);
            $users = User::where('role', 'user')->get();
        }
        return view('home.index',['products' =>$products, 'users' => $users,'userAdded'=>$userAdded]);
    }




}
