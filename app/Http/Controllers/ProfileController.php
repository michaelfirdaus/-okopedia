<?php

namespace App\Http\Controllers;

use Auth;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.profile')->with('user', Auth::user())->with('profile', Profile::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'about' => 'required',
        // ]);

        // $user = Auth::user();

        // if($request->hasFile('avatar')){
        //     $image = $request->file('avatar');

        //     $fullImage = time().'.'.$image->getClientOriginalExtension();
    
        //     $path = public_path('/uploads/avatars/');
    
        //     $image->move($path, $fullImage);

        //     $user->profile->avatar = $fullImage;

        //     $user->profile()->save();
        // }

        // $user->name = $request->name;
        // $user->email = $request->email;
        
        // $user->save();
        // $user->profile()->save();

        // if($request->has('password')){
        //     $user->password = bcrypt($request->password);
        // }

        // Session::flash('success', 'Account profile updated.');

        // return redirect()->back();

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
