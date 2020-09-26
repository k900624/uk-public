<?php

namespace App\Http\Requests\Admin\Articles;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
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
            'message' => 'required|string',
            'status'  => 'string|nullable',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['message']     = filter_intro($data['message']);

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }

    public function messages()
    {
        return [

        ];
    }
}
