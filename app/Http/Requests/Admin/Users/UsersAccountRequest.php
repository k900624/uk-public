<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required|string|min:3|max:255',
            'email'                 => 'required|string|email',
            'password'              => 'string|confirmed|nullable|min:8|max:20',
            'group_id'              => 'nullable',
            'created_at'            => 'date_format:Y-m-d H:i:s',
            'updated_at'            => 'date_format:Y-m-d H:i:s',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['name']  = filter_title($data['name']);

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }

    public function messages()
    {
        return [
            'email.unique' => 'Такой email уже занят',
        ];
    }
}
