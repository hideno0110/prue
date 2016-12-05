<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Admin;
use App\Merchant;
use App\Role;
use Hash;
use Auth;
use DB;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {

        $this->middleware('auth:admin');
    }

   public function index()
    {
      //Auth情報からログインユーザーのmerchant_idを取得
      $merchant_id = Merchant::merchantUserCheck();

      $users = Admin::where('merchant_id', $merchant_id)->get();

      return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $input = $request->all();
        
        try {
          //トランザクション開始
         DB::beginTransaction();

          if($file = $request->file('photo_id')){
              $name = time().$file->getClientOriginalName();

              $environment = App::environment();
              if($environment == 'production') {
                  $file->move('public/images', $name);
              } else {
                  $file->move('images', $name);
              }

              $photo = Photo::create(['file'=>$name]);
              $input['photo_id'] = $photo->id;
          }
          $input['password'] = bcrypt($request->password);
          //merchant_idの取得
          $input['merchant_id'] = Merchant::merchantUserCheck();
          

          Admin::create($input);

          //コミット
          DB::commit();
        } catch (Exception $e) {
           DB::rollBack();
           return Redirect::back();
        }

        return redirect('/admin/users')->with('flash_message',trans('adminlte_lang::message.created_msg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.errors.404'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //Auth情報からログインユーザーのmerchant_idを取得
      $merchant_id = Merchant::merchantUserCheck();

      if(Admin::where('merchant_id', $merchant_id)->find($id)) {
        $user = Admin::findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));

      } else {
        return view('admin.errors.404'); 
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = Admin::findOrFail($id);
        $input =  $request->all();

        try {
            //トランザクション開始
            DB::beginTransaction();

            if($file = $request->file('photo_id')) {

                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $photo = Photo::create(['file'=>$name]);
                $input['photo_id'] = $photo->id;
            }
            $input['password'] = bcrypt($request->password);

            $user->update($input);
            //コミット
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back();
        }

        return redirect('admin/users')->with('flash_message',trans('adminlte_lang::message.updated_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user  = Admin::findOrFail($id);
      try {
      
        $user->delete();

      } catch (Exception $e) {
        return Redirect::back();
      }

      // Session::flash('deleted_user','The use has been deleted');

      return redirect('admin/users')->with('flash_message',trans('adminlte_lang::message.deleted_msg'));
    }
}
