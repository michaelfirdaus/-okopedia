<?php

namespace App\Http\Controllers;

use App\User;
use Session;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Redirecting user to admin/users/profile view and pass the current user's ID
        return view('admin.users.profile')->with('user', User::find(Auth::user()->id));
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
        //Find current user's ID
        $user = User::find($id);

        //Validate that name should be filled
        //Validate that email should be filled and must be an email format
        //Validate that password should be filled and at least 5 characters long
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        //Check if user upload an image,
        //saving an image by rename them and placing them on specific folder
        if($request->hasFile('avatar')){
            $image = $request->file('avatar');

            $fullImage = time().'.'.$image->getClientOriginalExtension();
    
            $path = public_path('/uploads/avatars/');
    
            $image->move($path, $fullImage);

            $user->avatar = $fullImage;
        }

        //Encrypt user's password
        if($request->password != ''){
            $user->password = bcrypt($request->password);
        }
       
        $user->name = $request->name;
        $user->email = $request->email;

        //Update current user to the database
        $user->update();

        //Notify user with pop up message
        Session::flash('success', 'Profile updated successfully.');

        //Redirecting user back (recent view)
        return redirect()->back();
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
