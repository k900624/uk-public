<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersEditRequest extends FormRequest
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
            // 'status'             => 'integer|nullable',
            // 'avatar'             => 'sometimes|file|image|mimes:gif,jpg,jpeg,png|max:5120',
            'vkontakte'          => 'string',
            'odnoklassniki'      => 'string',
            'facebook'           => 'string',
            'twitter'            => 'string',
            'telegram'           => 'string',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['name']             = filter_title($data['name']);
        // $data['address']          = filter_title($data['address']);
        $data['phone']            = filter_title($data['phone']);
        $data['phone2']           = filter_title($data['phone2']);

        $data['odnoklassniki']    = trim(remove_http(filter_title($data['odnoklassniki'])), '/');
        $data['vkontakte']        = trim(remove_http(filter_title($data['vkontakte'])), '/');
        $data['facebook']         = trim(remove_http(filter_title($data['facebook'])), '/');
        $data['twitter']          = trim(remove_http(filter_title($data['twitter'])), '/');
        $data['telegram']         = trim(remove_http(filter_title($data['telegram'])), '/');

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
