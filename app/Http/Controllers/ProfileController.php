<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = Auth::user()->id;
        $prf = User::find($userid)->profile()->first();
        return view('profile.p_index',compact('prf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $profile = new Profile;
        $profile->full_name = Request('full_name');
        $profile->Dateofbirth = Request('date_of_birth');
        $profile->Religion = Request('religion');
        $profile->school = Request('school');
        $profile->college = Request('college');
        $profile->university = Request('university');
        $profile->works_at = Request('work');
        $user->profile()->save($profile);
        return redirect('/profile');
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
       return view('profile.edit',compact('profile'));
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
        $prfup = Profile::find($profile->id);
        $prfup->full_name = Request('full_name');
        $prfup->Dateofbirth = Request('date_of_birth');
        $prfup->Religion = Request('religion');
        $prfup->school = Request('school');
        $prfup->college = Request('college');
        $prfup->university = Request('university');
        $prfup->works_at = Request('work');
        $prfup->save();
        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
