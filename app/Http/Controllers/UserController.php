<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreNewUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::all()->except(Auth::user()->id);
        return view('users.index', ['users' => $users]);
    }

    
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewUser $request)
    {
        $data = $request->all();
    
        // Handle image upload
        $imagePath = $request->file('image')->store('images', 'public');
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['password'] = $hashedPassword;
        $data['profile_pic'] = $imagePath;

        // Create a new user
        $user = User::create($data);
    
        // Redirect to the appropriate route based on success or failure
      
            return to_route('users.index');
        
    
    

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) 
    {
        
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser $request, User $user)
    {
        
    
        $data = $request->all();
       

        // Update the user's information
      
        if ($request->hasFile('image')) {
            if(Storage::exists('public/'.$user->profile_pic)){
                unlink('storage/'.$user->profile_pic);
            }
          

            $imagePath = $request->file('image')->store('images', 'public');
            $user->profile_pic = $imagePath;
        }
    
          $user->update($data);
   
            return to_route('users.show', $user->id);
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(Storage::exists('public/'.$user->profile_pic)){
            unlink('storage/'.$user->profile_pic);
        }

        $user->delete();

        return to_route('users.index');


    }


    public function myProfile(){
        $user = Auth::user();
        return view('users.myprofile',['user'=>$user]);
    }


    

    
}
