<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','parent_id','description','image','status','slug'
    ];


  public static function rules($id = 0){
    return [
        'name'=>[
            'required',
            'string',
            'min:3',
            'max:255',
            Rule::unique('categories','name')->ignore($id),
            function($attrubute, $value, $fails){
                    if(strtolower($value) == 'administrator'){
                          $fails('This Name Is Not Availabel');
                    }
            }
        ],
        'parent_id' => [
            'nullable',
            'int',
            'exists:categories,id'
        ],
        'image' =>[
            'image',
            'max:1048576',
            'dimensions:min_width=100,min_height=100'
        ],
        'status' => 'required|in:active,archived',
    ];
  }
}
