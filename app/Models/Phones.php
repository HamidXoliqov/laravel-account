<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{
    protected $table = 'phones';

    protected $fillable = [
        'number',
        'account_id',
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

    public function getAccount()
    {
        if (!empty(Accounts::find($this->account_id))) {
            return Accounts::find($this->account_id)->name;
        }

        return "No account";
    }
}
