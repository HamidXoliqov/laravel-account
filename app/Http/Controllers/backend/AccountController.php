<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Redirect;

use App\Models\Accounts;
use App\Models\Phones;
use App\Models\Email;



class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Accounts::orderBy('created_at', 'desc')->paginate(30);

        return view('backend.account.index',compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.account.create');
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
            'name' => ['required', 'string', 'min:3','max:50', 'unique:accounts']
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else
        Accounts::add($request->all());
        return redirect()->route('account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!empty(Accounts::find($id)))
        {
            $account = Accounts::find($id);
            return view('backend.account.view',compact('account'));
        }
        return redirect()->route('account.index');        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!empty(Accounts::find($id)))
        {
            $account = Accounts::find($id);
            return view('backend.account.edit',compact('account'));
        }
        return redirect()->route('account.index');
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
        if(!empty(Accounts::find($id)))
        {
            $account = Accounts::find($id);

            $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3','max:50', 'unique:accounts']
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            else
            $account->edit($request->all());
        }
        return redirect()->route('account.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Accounts::find($id);
        if($account->delete())
        {
            if(Phones::query()
                ->where('account_id',$id)
                ->delete()
                && Email::query()
                ->where('account_id',$id)
                ->delete()
            )
            {
                return back();
            }
            return redirect()->route('account.index');
        }

        return redirect()->route('account.index');

    }

    public function contact($id)
    {
        if(!empty(Accounts::find($id)))
        {
            $account = Accounts::find($id);
            return view('backend.account.contact',compact('account'));
        }
        return redirect()->route('account.index');
    }    

    public function status($id)
    {
        $account = Accounts::find($id);
        if($account->status ==1)
        {
            $account->status = 0;
        }
        else
        {
            $account->status = 1;
        }
        if($account->save()){
            echo json_encode('success');
        }
        else{
            echo json_encode('error');
        }
    }

    public function search()
    {
        $query = Accounts::query();
        if (isset($_GET["q"]) && $_GET["q"]) {
            $key = $_GET["q"];    
            $accounts = $query->where('name','LIKE','%'.$key.'%')->orderBy('created_at', 'desc')->paginate(30);
            return view('backend.account.index',compact('accounts'));
        }
        $accounts = $query->paginate(30);
        return view('backend.account.index',compact('accounts'));

    }
}
