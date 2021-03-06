<?php 
namespace App\Http\Requests;

use App\Models\AbbottCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImportCards extends FormRequest
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
		$abbott_codes = AbbottCode::select('code')->pluck('code');
        return [
			'rows' => 'required',
			'fallback_brand_id' => 'required|numeric',

            'rows.*.abbott_code' => ['required', Rule::in($abbott_codes)],
            'rows.*.card_code' => 'required|min:14|alpha_num',

            'rows.*.first_name' => 'required_with:rows.*.last_name,rows.*.phone_number|max:255',
            'rows.*.last_name' => 'required_with:rows.*.first_name,rows.*.phone_number|max:255',
            'rows.*.phone_number' => 'required_with:rows.*.first_name,rows.*.last_name',
            'rows.*.email' => 'nullable|email',
        ];
    }

    public function attributes()
    {
        return [
            '0' => 'Abbott code',
            '1' => 'Card code',
            '2' => 'Last name',
            '3' => 'First name',
            '4' => 'Mobile number',
            '5' => 'Email'
        ];
    }
}
