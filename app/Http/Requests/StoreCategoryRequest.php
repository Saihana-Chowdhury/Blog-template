<?php
namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class StoreCategoryRequest extends FormRequest
{
public function authorize(): bool { return true; }


public function rules(): array
{
$id = $this->route('category')?->id; // nullable for update
return [
'name' => ['required','string','max:255'],
'slug' => ['nullable','alpha_dash','max:255','unique:categories,slug'.($id?",$id":'')],
'description' => ['nullable','string']
];
}
}