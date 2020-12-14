<?php

namespace App\Models;
use App\Models\Phones;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $table = 'accounts';

    protected $fillable = [
        'name',
        'status',
    ];

    public static function add($filds)
    {
        $post = new static;
        $post->fill($filds);
        $post->save();
    }
    public function edit($filds)
    {
        $this->fill($filds); 
        $this->save();
    }

    public function getPhone($id)
    {
        if (!empty(Phones::where('account_id',$id)->get())) {
            return Phones::where('account_id',$id)->get();
        }
        return "No number";
    }

    public function getEmail($id)
    {
        if (!empty(Email::where('account_id',$id)->get())) {
            return Email::where('account_id',$id)->get();
        }
        return "No number";
    }
}
