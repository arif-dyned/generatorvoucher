<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Libraries\Assets;

use App\Http\Models\User;

use Auth, DB, Hash, Redirect, Session, Validator;

class CustomAuthController extends Controller
{
	// login page
    public function login(){
        $this->data['title'] = 'Login';
        $this->data['css'] = Assets::load('css', ['bootstrap', 'admin-custom', 'dyned-skins', 'dsa-font']);
        $this->data['js'] = Assets::load('js', ['jquery-2', 'bootstrap', 'app']);

        return view('layout/template')->with('data', $this->data)
                                  ->nest('content', 'auth/login', array('data' => $this->data));
    }

    // authencticate user
    public function authenticate(Request $request){
    	$rules = array(
            'username' => 'required',
            'password' => 'required',
		);

		$validator 	= Validator::make($request->all(), $rules);


		if(!$validator->fails()){
			$user = User::where('username', $request->username)->first();

			//dd(Hash::make($request->password));
			//dd(Hash::check($request->password, $user->password));

			if(!EMPTY($user)){
	    		if (Auth::attempt([ 'username' => $request->username, 'password' => $request->password ], true)) {

	    			$user->save();

	            	return redirect('/');
				}else{
		        	return redirect('login')->withInput()->with('error', 'username or password not match');
		        }
			}else{
				return redirect('login')->with('error', 'Username not found');	
			}

		}else{
			return redirect('login')->withInput()->with('error', $validator->errors());
		}
    }

    // logout user
    public function logout(){
    	Auth::logout();

    	return redirect('login');
    }

    // create user
    public function create(Request $request){
    	$user = new User;

    	$rules = array(
			'username' => 'required|min:5|max:45|unique:users,username',
            'full_name' => 'required|min:3',
            'status' => 'required|in:administrator,developer,tester',
            'password' => 'required|min:6|confirmed',
		);

    	$validator 	= Validator::make($request->all(), $rules);

    	if(!$validator->fails()){
    		try{
				$user->username = $request->username;
				$user->full_name = $request->full_name;
				$user->status = $request->status;
				$user->password = Hash::make($request->password);

				$user->save();

    		}catch(\Exception $e){
				return redirect('user-manager/create')->withInput()->with('error', $e->getMessage() . ' in line : ' . $e->getLine());
    		}
			
			return redirect('user-manager')->with('success', "$user->username successfully added");

    	}else{
    		return redirect('user-manager/create')->withInput()->with('error', $validator->errors());
    	}
    }

    // update user
    public function update(Request $request, $id = ''){
    	$user = $id == '' ? Auth::user() : User::where('id', $id)->where('status', '!=', 'master')->first();
    	$link = $id == '' ? 'user-manager/profile' : 'user-manager/profile/' . $id;
    	$status = $user->status == 'master' ? 'master' : 'administrator,developer,tester';
    	$id = $user->id;

    	$rules = array(
			'username' => 'required|min:5|max:45|unique:users,username,'.$id,
            'full_name' => 'required|min:3',
            'status' => 'required|in:' . $status,
            'password' => 'required|min:6|confirmed',
		);

    	$validator 	= Validator::make($request->all(), $rules);

    	if(!$validator->fails()){
    		try{
				$user->username = $request->username;
				$user->full_name = $request->full_name;
				$user->status = $request->status;
				$user->password = Hash::make($request->password);

				$user->save();

    		}catch(\Exception $e){
				return redirect($link)->withInput()->with('error', $e->getMessage() . ' in line : ' . $e->getLine());
    		}
			
			return redirect('user-manager')->with('success', "$user->username successfully updated");

    	}else{
    		return redirect($link)->withInput()->with('error', $validator->errors());
    	}
    }

    // delete user
    public function remove(Request $request){
    	if($request->ajax()){
	    	$id = $_POST['id'];

	    	$user = User::findOrFail($id);

	    	if($user->delete()){
	        	$request->session()->flash('success', 'Username : ' . $user->username . ' Successfully Deleted');
	        }
	    }
    }
}
