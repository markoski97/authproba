<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFileRequest extends StoreFileRequest//gi emame rules od store file
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
{
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
        return array_merge(parent::rules(),//ova go prajme za da go dodajme live na vejce dodadenio array od StoreFileRquest
            [
                'live'=>'',
            ]);
    }

    public function messages(){//ovaj cel metod se koristi za costum poraka ako failni requesto
        return [
        ];
    }
}
//SETO OVA SE PRAJ ZA DA NEMAS 100 REQUEST FAJLOJ KAKO SO IMAS VO DIPLOMSKATA