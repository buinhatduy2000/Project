<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Account;
use App\Models\Idea;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function login(Request $request)
    {
        return view('login');
    }

    public function postLogin(Request $request){
        if(Auth::guard('account')->attempt($request->only('user_name','password'))){
            return redirect()->route('home');
        }
        $request->session()->flash('check_email','Please check email and password');
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        Auth::guard('account')->logout();
        return redirect()->route('login');
    }

    public function viewInfo ($id) {
        $account = Account::find($id);
        $ideas = Idea::where('user_id', $id)->get();
        if(request()->sort_by == 'popular'){
            $ideas = Idea::where('user_id', $id)->get()->sortByDesc('views');

        }
        else if(request()->sort_by == 'newtest'){
            $ideas = Idea::where('user_id', $id)->get()->sortByDesc('created_at');
        }
        else if(request()->sort_by == 'like'){
            dd(request()->sort_by);
        }
        else if(request()->sort_by == 'comments'){
            $ideas = Idea::where('user_id', $id)->withCount('comments')->orderBy('comments_count', 'desc')->get();
        }
        return view('viewInfo', ['account' => $account, 'ideas' => $ideas]);
    }

    public function listUser(Account $account)
    {
//        if (! Gate::allows('list-user', $account)) {
//            return redirect()->route('login')->with('error','You do not have permission');
//        }
        $users = Account::where('role', '!=', Account::ACCOUNT_ADMIN)->paginate(5);
        return view('listUser', compact('users'));
    }

     public function createUser()
     {
         return view('createUser');
     }

     public function storeUser(UserRequest $request)
     {
         $user = Account::create([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
             'role' => $request->role,
         ]);
         $lastInsertId = DB::getPdo()->lastInsertId();
         $personal = Personal::create([
             'user_id' => $lastInsertId,
             'first_name' => $request->first_name,
             'last_name' => $request->last_name,
             'email' => $request->email,
             'address' => $request->address,
             'department' => $request->department,
             'dob' => $request->dob,
             'phone_number' => $request->phone_number,

         ]);
         if (!$user || !$personal) {
             return redirect()->back()->with('error', 'Create User Not Success');
         }
         return redirect()->route('adminListUser')->with('success', 'Create User Success');
     }

     public function editUser($id)
     {
        $account = Account::find($id);
        if (!$account){
            return redirect()->back()->with('error', 'Account do not exist');
        }
        return view('editUser', compact('account'));
     }

     public function updateUser(UserRequest $request, $id)
     {
        $account = Account::find($id);
        if (!$account) {
            return redirect()->back()->with('error', 'Account do not exist');
        }
        $personal = Personal::where('user_id',$id);
        $updateAccount = $personal->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'department' => $request->department,
            'dob' => $request->dob,
            'phone_number' => $request->phone_number,
        ]);
         if (!$updateAccount) {
             return redirect()->back()->with('error', 'Update User Not Success');
         }
         return redirect()->route('adminListUser')->with('success', 'Update User Success');
     }

     public function deleteUser($id)
     {
         $account = Account::find($id);
         if ($account){
             $personal = Personal::where('user_id', $id);
             $personal->delete();
             $delete_account = $account->delete();
             if (!$delete_account){
                 return redirect()->back()->with('error', 'Delete User Not Success');
             }
             return redirect()->route('adminListUser')->with('success', 'Delete User Success');
         }
     }
}
