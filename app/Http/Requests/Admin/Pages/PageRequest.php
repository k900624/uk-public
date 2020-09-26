<?php

namespace App\Http\Requests\Admin\Pages;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title'           => 'required|string|min:3|max:255',
            'alias'           => 'string|max:255|unique:content,alias,'. $this->segment(3),
            'fulltext'        => 'required|string',
            'metakey'         => 'max:500|string|nullable',
            'metadesc'        => 'max:500|string|nullable',
            'published'       => 'integer|nullable',
            'created_at'      => 'date_format:Y-m-d H:i:s',
            'updated_at'      => 'date_format:Y-m-d H:i:s',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['title']      = filter_title($data['title']);
        $data['alias']      = clean($data['alias']);
        $data['fulltext']   = filter_fulltext($data['fulltext']);
        $data['metakey']    = filter_intro($data['metakey']);
        $data['metadesc']   = filter_intro($data['metadesc']);

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
