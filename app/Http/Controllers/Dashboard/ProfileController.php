<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\freelancer\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->freelancer;
    
        return view('categories.profile' , compact('user' , 'profile'));
    }

    public function update(Request $request)
    {
        $request->validate([    
            'first_name' => ['required'],
        ]);
    
        $user = Auth::user();
        
        $data = $request->except('image_path');
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->save();
        if($request->hasFile('image_path')){
            
            
       
            $file = $request->file('image_path');
            // dd($file);
            if($file->isValid())
            {
                // $filename = time().$file->getClientOriginalName();
                $path = $file->store('profiles' , [
                        'disk'=>'public'
                    ]);
                    $data['image_path'] = $path;
                }
            }
            // dd($data);
             $user->freelancer()->updateOrCreate([
            'user_id' => $user->id,
        ], $data);
        return redirect()->route('profile')->with('success' , 'Profile Updated Successfully');
    }
}