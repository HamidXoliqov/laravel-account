<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\Models\Email;
use App\Models\Accounts;

class EmailController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::orderBy('created_at', 'desc')->paginate(30);
        return view('backend.email.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Accounts::all()->pluck('name','id');
        return view('backend.email.create',compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_name' => ['required', 'string', 'min:5','max:50', 'unique:emails','email'],
            'account_id' => ['required', 'integer', 'max:11'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else
        Email::add($request->all());
        return redirect()->route('email.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!empty(Email::find($id)))
        {
            $email = Email::find($id);
            return view('backend.email.view',compact('email'));
        }
        return redirect()->route('email.index');        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!empty(Email::find($id)))
        {
            $email = Email::find($id);
            $accounts = Accounts::all()->pluck('name','id');

            return view('backend.email.edit',compact('email','accounts'));
        }
        return redirect()->route('email.index');
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
        if(!empty(Email::find($id)))
        {
            $email = Email::find($id);
            $validator = Validator::make($request->all(), [
                'email_name' => ['required', 'string', 'min:5','max:50', 'unique:emails','email'],
                'account_id' => ['required', 'integer', 'max:11'],
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            else
            $email->edit($request->all());
        }
        return redirect()->route('email.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $email = Email::find($id);
        if($email->delete())
        {            
            return back();
        }

        return redirect()->route('email.index');
    }

    public function search()
    {
        $query = Email::query();
        if (isset($_GET["q"]) && $_GET["q"]) {
            $key = $_GET["q"];    
            $emails = $query->where('email_name','like',$key)->orderBy('created_at', 'desc')->paginate(30);
            return view('backend.email.index',compact('emails'));
        }
        $emails = $query->paginate(30);
        return view('backend.email.index',compact('emails'));

    }
}
