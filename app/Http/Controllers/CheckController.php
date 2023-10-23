<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date_from = '2023-01-01';
        $date_to = now()->addDays(1)->format('Y-m-d');

        $users = User::orderby('created_at','DESC')->get();
        $allUsers = User::where('id',"<>",Auth::user()->id)->orderby('created_at','DESC')->get();
        return view('checks.index',['allUsers'=>$allUsers,'users'=>$users,'date_from'=>$date_from,'date_to'=>$date_to]);
    }


    public function filter(Request $request){

        $date_from = $request->date_from&&$request->date_from < now()->addDays(1)->format('Y-m-d') ? $request->date_from : '2023-01-01';
        $date_to = $request->date_to&&$request->date_to<now()->addDays(1)->format('Y-m-d') ? $request->date_to : now()->addDays(1)->format('Y-m-d');
        $user = $request->user ?? null;

        $allUsers = User::where('id',"<>",Auth::user()->id)->orderby('created_at','DESC')->get();
        $users = User::orderby('created_at','DESC')->get();
        if($user&&$request->date_from < now()->addDays(1)&& $date_to<=now()->addDays(1)->format('Y-m-d')){

            $orders = Order::where('user_id', $user)
            ->whereBetween('created_at', [$date_from,$date_to])->orderByDesc('created_at')->get();

            if(count($orders)>0){

                $users = [
                  $orders[0]->user,
                ];
            }
        }
        return view('checks.index', ['allUsers' => $allUsers, 'users' => $users,'date_from'=>$date_from,'date_to'=>$date_to]);

    }
}
