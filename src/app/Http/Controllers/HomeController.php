<?php

namespace App\Http\Controllers;


use App\Http\Models\Organization;
use App\Http\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Libraries\Assets;
use Auth;


/*
  |--------------------------------------------------------------------------
  | Home Controller
  |--------------------------------------------------------------------------
  |
  | This controller is place for manages function for return view
  |
 */

class HomeController extends Controller
{

    public function __construct(Request $request)
    {

        $this->middleware('auth'); // => prevent the user is not logged in to enter CMS
        // $this->middleware('whitelist:group1'); // => prevent blacklisted ip to enter CMS

        $this->request = $request;
        $this->data['title'] = 'GENERATOR VOUCHER';
        $this->data['css'] = Assets::load('css', ['bootstrap-fileupload', 'bootstrap-min', 'bootstrap-reset', 'datatables', 'font-awesome', 'jquery-ui', 'style', 'select2']);
        $this->data['js'] = Assets::load('js', ['jquery', 'jquery-1.8.3', 'bootstrap', 'jquery-ui', 'accordion', 'scrollTo', 'nicescroll', 'switch', 'fileupload', 'ckeditor', 'inputmask', 'select2', 'scripts', 'advanced-form', 'validate-jquery', 'validate-init', 'datatables', 'datatables-bootstrap', 'selectize']);
    }

    // dashboard page
    public function index()
    {
        $data = '';

        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'dashboard', ['data' => $data]);
    }

    public function usermanager()
    {
        $data = User::where('status', '!=', 'master')->get();

        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'user_manager/index', ['data' => $data]);
    }

    public function createUser()
    {
        $this->data['js'] = Assets::add($this->data['js'], 'js', ['pass-strength']);

        if (Auth::user()->status == 'tester' || Auth::user()->status == 'developer') {
            return redirect('user-manager')->with('error', "you're not allowed to access that page");
        }

        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'user_manager/_form');
    }

    public function profile($id = '')
    {
        $this->data['js'] = Assets::add($this->data['js'], 'js', ['pass-strength']);

        $data = empty($id) ? Auth::user() : User::where('id', $id)->first();

        if ($id !== '' && ((Auth::user()->status == 'tester' || Auth::user()->status == 'developer') || (Auth::user()->status !== 'master' && $data->status == 'master'))) {
            return redirect('user-manager')->with('error', "you're not allowed to access that page");
        }
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'user_manager/_form', array('data' => $data));
    }

    // home ->
    public function organization()
    {
        $this->data['css'] = Assets::add($this->data['css'], 'css', ['circle']);
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'organization/main');
    }

    public function grade()
    {
        $this->data['css'] = Assets::add($this->data['css'], 'css', ['circle']);
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'grade/main');
    }

    public function position()
    {
        $this->data['css'] = Assets::add($this->data['css'], 'css', ['circle']);
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'position/main');
    }

    public function organization_level()
    {
        $this->data['css'] = Assets::add($this->data['css'], 'css', ['circle']);
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'organization_level/main');
    }

    public function form_add_organization()
    {
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'organization/form');
    }

    public function form_edit_organization($id)
    {
        $data = Organization::findOrFail($id);
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'organization/form', ['data' => $data]);
    }

    public function form_detail_organization()
    {
        $this->data['css'] = Assets::add($this->data['css'], 'css', ['circle']);
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'employee/master');
    }

    //--------------------------END MODAL ---------------------------//

}
