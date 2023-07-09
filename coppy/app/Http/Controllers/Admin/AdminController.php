<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\Admin;
use Auth;
use Datatables;
use Avatar;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }


    

    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('role:super');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {

            // return datatables()->of(Admin::latest()->get())->make(true);
            $query = Admin::query();
            $query->whereRaw("admins.id !=" . Auth::guard('admin')->user()->id );
            $admins = $query->select('*');
            
            return datatables()->of($admins)->addColumn('control' , function($data){
                $button = '<a href="'. route("admin.delete",[$data->id]) .'" class="btn btn-sm btn-danger mr-3">'.trans('app.delete').'</a>';
                return $button;
            })->addColumn('id', function($data){
                return $data->id;
            })->addColumn('city', function($data){
                return $data->city->name;
            })->addColumn('role' , function($data) {
                $roles = '' ;
                foreach ($data->roles as $role) {
                    $roles .= '<span class="badge badge-success badge-roundless">
                               '. $role->name . '
                            </span> ';
                }
                return $roles;
            })->rawColumns(['control' , 'role'])->make(true);
        }
        return view('admin.auth.show');
    }

    public function showChangePasswordForm()
    {
        return view('admin.auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'oldPassword'   => ['required' , new MatchOldPassword],
            'password'      => 'required|min:6|confirmed',
        ]);

        
        Admin::find(Auth::guard('admin')->user()->id)->update(array(
            'password' => bcrypt($request->password)
        ));

        return redirect(route('admin.dashboard'))->with(['type' => 'success' , 'message' => trans('app.passwordSuccess')]);
    }


    public function showAdminProfile() {
        return view('admin.profile');
    }
}
