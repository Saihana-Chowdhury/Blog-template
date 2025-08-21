<?php
namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class StorePostRequest extends FormRequest
{
public function authorize(): bool { return true; }


public function rules(): array
{
$id = $this->route('post')?->id;
return [
'title' => ['required','string','max:255'],
'slug' => ['nullable','alpha_dash','max:255','unique:posts,slug'.($id?",$id":'')],
'excerpt' => ['nullable','string','max:500'],
'content' => ['required','string'],
'category_id' => ['required','exists:categories,id'],
];
}
}