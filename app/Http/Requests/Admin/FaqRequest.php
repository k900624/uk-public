<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
            'question'        => 'required|string|min:3|max:255',
            'answer'          => 'required|string',
            'cat_id'          => 'sometimes|required|integer',
            'published'       => 'integer|nullable',
            'created_at'      => 'date_format:Y-m-d H:i:s',
            'updated_at'      => 'date_format:Y-m-d H:i:s',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['question']  = filter_title($data['question']);
        $data['answer']    = filter_fulltext($data['answer']);

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
