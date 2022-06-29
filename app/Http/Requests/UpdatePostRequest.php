<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */


    public function rules()
    {
        $rules= [

            'title_edit'=>[
                    'required',
                    'unique:posts,title',
                    'string',
                    'min:15',
                    'max:25',

                ],




            'content_edit'=>[
                    'required',
                    'min:25'

                ],






            // 'images_for_edit.*' =>
            //             [

            //                 'image',
            //                 'max:2048',

            //                 'mimes:jpeg,png,jpg,gif,svg|',
            //                 'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'

            //             ]


            //
        ];
        return $rules;
        //
    }

    public function messages()
    {
        return [
            'title.required'=>"أدخل عنوان المقال ",
            'title.min'=>"عنوان المقال قصير جدا ",
            'title.max'=>"عنوان المقال طويل جدا",
            'title.string'=>"عنوان المقال  غير مناسب",
            'title.unique'=>" هذا العنوان مكرر    ",


            'content.required'=>"يجب ادخال محتوي",
            'content.min'=>"المقال قصير جدا",

            'images.required'=>"يجب اختبار صورة معبرة",
            'images.max'=>"اختر صورة أقل حجما",
            'images.*.image'=>'هذا النوع غير مقبول',
            'images.*.dimensions'=>'هذا المقاس غير مناسب',
            'images.*.mimes'=>'هذا الامتداد غير متاح'

        ];
    }

}
