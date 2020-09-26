<?php

namespace App\Http\Requests\Front\Users;

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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user.phone'         => 'required|string',
            'user.phone2'        => 'required|string',
            // 'avatar'             => 'sometimes|file|image|mimes:gif,jpg,jpeg,png|max:5120',
            'user.vkontakte'     => 'string',
            'user.odnoklassniki' => 'required|string',
            'user.facebook'      => 'string',
            'user.twitter'       => 'string',
            'user.telegram'      => 'string',
            'token'              => 'required',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['phone']         = filter_title($data['phone']);
        $data['phone2']        = filter_title($data['phone2']);
        $data['odnoklassniki'] = trim(remove_http(filter_title($data['odnoklassniki'])), '/');
        $data['vkontakte']     = trim(remove_http(filter_title($data['vkontakte'])), '/');
        $data['facebook']      = trim(remove_http(filter_title($data['facebook'])), '/');
        $data['twitter']       = trim(remove_http(filter_title($data['twitter'])), '/');
        $data['telegram']      = trim(remove_http(filter_title($data['telegram'])), '/');

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
