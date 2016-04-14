<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class UserRequest extends Request {

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
        $id = '';
        $password = 'required|min:6|confirmed';
        if ($this->get('email') && $this->method() == 'PUT') {
            $user = User::findByEmail($this->get('email'))->first();
            if ($user) {
                $id = ',email,'.$user->id;
            }
            $password = 'min:6|confirmed';
        }
        return [
            'fio' => 'required',
            'organisation' => 'required',
            'password' => $password,
            'email' => 'required|unique:users'.$id
        ];
    }

}
