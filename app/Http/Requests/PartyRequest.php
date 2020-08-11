<?php


namespace App\Http\Requests;


use App\Obfuscator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PartyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'=>'required',
            'users.*.name'=>'required',
        ];

        // on put, ignore email check on party members
        if ($this->route('party')) {

            $rules['email'] = [
                'required_unless:system_access,0',
                'email',
                Rule::unique('users')->ignore($this->route('party')->id, 'party_id')
            ];
        }
        else{
            $rules['email'] = [
                'required_unless:system_access,0',
                'email',
                Rule::unique('users')
            ];
        }

        return $rules;
    }
}
