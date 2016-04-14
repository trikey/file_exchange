<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class FolderRequest extends Request {

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
        if ($this->get('is_ajax') && $this->method() == 'PUT') {
            if ($this->get('parent_id') == $this->get('id')) {
                return false;
            }
            return [];
        }
        return [
            'name' => 'required'
        ];
    }

}
