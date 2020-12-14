<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\Models\Phones;
use App\Models\Accounts;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phones = Phones::orderBy('created_at', 'desc')->paginate(30);
        return view('backend.phone.index',compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Accounts::all()->pluck('name','id');
        return view('backend.phone.create',compact('accounts'));
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
                'number' => ['required', 'string', 'min:9', 'max:50', 'unique:phones'],
                'account_id' => ['required', 'integer', 'max:11'],
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            else
        Phones::add($request->all());
        return redirect()->route('phone.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!empty(Phones::find($id)))
        {
            $phone = Phones::find($id);
            return view('backend.phone.view',compact('phone'));
        }
        return redirect()->route('phone.index');        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!empty(Phones::find($id)))
        {
            $phone = Phones::find($id);
            $accounts = Accounts::all()->pluck('name','id');

            return view('backend.phone.edit',compact('phone','accounts'));
        }
        return redirect()->route('phone.index');
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
        if(!empty(Phones::find($id)))
        {
            $phone = Phones::find($id);
            $validator = Validator::make($request->all(), [
                'number' => ['required', 'string', 'min:9', 'max:50', 'unique:phones'],
                'account_id' => ['required', 'integer', 'max:11'],
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            else
            $phone->edit($request->all());
        }
        return redirect()->route('phone.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phone = Phones::find($id);
        if($phone->delete())
        {            
            return back();
        }

        return redirect()->route('phone.index');

    }

    public function search()
    {
        $query = Phones::query();
        if (isset($_GET["q"]) && $_GET["q"]) {
            $key = $_GET["q"];    
            $phones = $query->where('number','LIKE','%'.$key.'%')->orderBy('created_at', 'desc')->paginate(30);
        return view('backend.phone.index',compact('phones'));
        }
        $phones = $query->paginate(30);
        return view('backend.phone.index',compact('phones'));
    }
}
