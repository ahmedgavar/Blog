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
            'title_edit.required'=>"أدخل عنوان المقال ",
            'title_edit.min'=>"عنوان المقال قصير جدا ",
            'title_edit.max'=>"عنوان المقال طويل جدا",
            'title_edit.string'=>"عنوان المقال  غير مناسب",
            'title_edit.unique'=>" هذا العنوان مكرر    ",


            'content_edit.required'=>"يجب ادخال محتوي",
            'content_edit.min'=>"المقال قصير جدا",

            'images_for_edit.required'=>"يجب اختبار صورة معبرة",
            'images_for_edit.max'=>"اختر صورة أقل حجما",
            'images_for_edit.*.image'=>'هذا النوع غير مقبول',
            'images_for_edit.*.dimensions'=>'هذا المقاس غير مناسب',
            'images_for_edit.*.mimes'=>'هذا الامتداد غير متاح'

        ];
    }

}
