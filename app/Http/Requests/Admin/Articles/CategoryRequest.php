<?php

namespace App\Http\Requests\Admin\Articles;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title'       => 'required|string|min:3|max:255',
            'alias'       => 'string|max:255|unique:categories,alias,'. $this->segment(3),
            'description' => 'max:500|string|nullable',
            'parent_id'   => 'integer',
            'metakey'     => 'max:500|string|nullable',
            'metadesc'    => 'max:500|string|nullable',
            'ordering'    => 'integer',
            'published'   => 'integer|nullable',
            'image'       => 'sometimes|file|image|mimes:gif,jpg,jpeg,png|max:5120',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['title']       = filter_title($data['title']);
        $data['alias']       = clean($data['alias']);
        $data['description'] = filter_intro($data['description']);
        $data['metakey']     = filter_intro($data['metakey']);
        $data['metadesc']    = filter_intro($data['metadesc']);

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }

    public function messages()
    {
        return [

        ];
    }
}
