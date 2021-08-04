<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if(empty($user->profile)) {
            return view('user.profiles.create', [
                'user' => $user
            ]);
        } 
        
        return redirect('user/galleries');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Profile $profile)
    {
        $user = auth()->user();
        $data = $request->all();
        
        $validator = Validator::make($data,[
            'display_name' => ['required', 'string'],
            'jobName' => ['required', 'integer'],
            'storyName' => ['required', 'integer'],
            'introduction' => ['required', 'string']
        ]);
        
        $validator->validate();
        $profile->profileStore($user->id, $data);
        
        return redirect('user/users/' . $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $user = auth()->user();
        $profiles = $profile->getEditProfile($user->id, $profile->id);
        
        if (!isset($profiles)) {
            return redirect('user/galleries');
        }
        
        return view('user.profiles.edit',[
            'user' => $user,
            'profiles' => $profiles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $data = $request->all();
        
        $validator = Validator::make($data,[
            'display_name' => ['required', 'string'],
            'jobName' => ['required', 'integer'],
            'storyName' => ['required', 'integer'],
            'introduction' => ['required', 'string']
        ]);
        
        $validator->validate();
        $profile->profileUpdate($data);
        
        return redirect('user/galleries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $user = auth()->user();
        $profile->profileDestroy($user->id, $profile->id);
        
        return redirect('user/profiles/create');
    }
}
