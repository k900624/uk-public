<?php

namespace App\Http\Requests\Admin\Articles;

use Illuminate\Foundation\Http\FormRequest;

class AdvertRequest extends FormRequest
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
            'introtext'       => 'max:500|string|nullable',
            'fulltext'        => 'required|string',
            'cat_id'          => 'required|integer',
            'published'       => 'integer|nullable',
            'image'           => 'sometimes|file|image|mimes:gif,jpg,jpeg,png|max:5120',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['title']      = filter_title($data['title']);
        $data['alias']      = clean($data['alias']);
        $data['introtext']  = filter_intro($data['introtext']);
        $data['fulltext']   = filter_fulltext($data['fulltext']);

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
