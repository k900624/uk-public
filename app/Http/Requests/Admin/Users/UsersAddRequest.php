<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersAddRequest extends FormRequest
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
            'name'               => 'required|string|min:3|max:255',
            // 'address'            => 'required|string',
            'phone'              => 'required|string',
            'phone2'             => 'required|string',
            'status'             => 'integer|nullable',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['name']             = filter_title($data['name']);
        // $data['address']          = filter_title($data['address']);
        $data['phone']            = filter_title($data['phone']);
        $data['phone2']           = filter_title($data['phone2']);

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
