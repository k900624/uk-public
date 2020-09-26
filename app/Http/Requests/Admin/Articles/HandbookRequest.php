<?php

namespace App\Http\Requests\Admin\Articles;

use Illuminate\Foundation\Http\FormRequest;

class HandbookRequest extends FormRequest
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
     * Execute a pre-validation treatment.
     *
     * @return void
     */
    public function before()
    {
        /*$this->merge([
            'alias'          => Str::slug($this->title),
        ]);*/
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
            'cat_id'          => 'required|integer',
            'published'       => 'integer|nullable',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['title']      = filter_title($data['title']);
        $data['alias']      = clean($data['alias']);
        $data['fulltext']   = filter_fulltext($data['fulltext']);

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
