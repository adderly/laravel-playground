<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the users, view filled with users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('users',['users' => User::where('name','!=' ,'admin')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
      error_log(" Yes ".var_dump($r->all()));
      $filtered = self::filterRequest($r);

      if(array_key_exists('enabled', $filtered))
        $filtered['enabled'] = $filtered['enabled'] == "on" ? 1 : 0;
      else $filtered['enabled'] = 0;

      $id = array_key_exists('id', $filtered) ? $filtered['id'] : -1;
      $user =  User::updateOrCreate(['id' =>  $id], $filtered);
    }

    public function delete(Request $r)
    {
      error_log(var_dump($r->all()));
      $id = $r->input('id');
      User::destroy($id);
    }

    public function enable(Request $r)
    {
      error_log(var_dump($r->all()));
      $f = self::filterRequest($r);
      if(array_key_exists('enabled', $f))
        $f['enabled'] = $f['enabled'] == "on" ? 1 : 0;
      else $f['enabled'] = 0;

      $u = User::find($f['id']);
      $u->enabled = $f['enabled'];
      $u->save();
    }

    function filterRequest(Request $r)
    {
      return array_filter($r->all(), function($v, $k) {
                      return $k != '_token';
                  }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}
}
