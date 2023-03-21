<?php

namespace App\Http\Controllers;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Adminindex(){
        return view('Admin.Page.indexAdmin');
    }

    public function Roleindex(){
        $role=Roles::all();
        return view('Admin.Page.Role.listRole', compact('role'));
    }

    public function getAddRole(){
        $role=Roles::all();
        return view('Admin.Page.Role.addRole', compact('role'));
    }

    public function postAddRole(Request $request){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                'name'=>'required',
                'description'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $role= new Roles;
            $role->name=$request->name;
            $role->description=$request->description;
            $role->save();
            return redirect()->route('admin.role.index')->with('success','Add new Role Successfully!');
        }
    }

    public function getUpdateRole($id){
        $data['role']=Roles::find($id);
        return view('Admin.Page.Role.updateRole', $data);
    }

    public function postUpdateRole(Request $request, $id){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                'name'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $role= Roles::find($id);
            $role->name=$request->name;
            $role->description=$request->description;
            $role->save();
            return redirect()->route('admin.role.index')->with('success','Update Role Successfully!');
        }
    }

    public function deleteRole($id) {
        $usersCount = User::where('role_id', $id)->count();
        if ($usersCount > 0) {
            return redirect()->back()->with('error', 'Some Accounts is associated with this Role so this Role cannot be deleted!');
        }
        
        Roles::where('id', $id)->delete();
        return redirect()->route('admin.role.index')->with('success', 'Delete Role Successfully!');
    }

    public function Accountindex(){
        $account=DB::table('human_resources')
        ->join('roles', 'human_resources.role_id', '=', 'roles.id')
        ->where('roles.name', '=', 'Staff')
        ->orWhere('roles.name', '=', 'Trainer')
        ->select('human_resources.*')
        ->get();
        $role=Roles::all();
        return view('Admin.Page.Account.listAccount', compact('role', 'account'));
    }

    public function getAddAccount(){
        $role=Roles::all();
        return view('Admin.Page.Account.addAccount', compact('role'));
    }

    public function postAddAccount(Request $request){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                'username'=>'required',
                'password'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $account= new User;
            $account->username=$request->username;
            $account->password=Hash::make($request->password);
            $account->role_id=$request->role_id;
            $account->save();
            return redirect()->route('admin.account.index')->with('success','Add new Account Successfully!');
        }
    }

    public function getUpdateAccount($id){
        $role=Roles::all();
        $data['account']=User::find($id);
        return view('Admin.Page.Account.updateAccount', $data, compact('role'));
    }

    public function postUpdateAccount(Request $request, $id){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[

            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $account= User::find($id);
            $account->username=$request->username;
            $account->password=Hash::make($request->password);
            $account->role_id=$request->role_id;
            $account->save();
            return redirect()->route('admin.account.index')->with('success','Update Account Successfully!');
        }
    }

    public function deleteAccount($id){
        $account=User::find($id);
        $account->delete();
        return back()->with('success', 'Delete user Successfully!');
    }
}
