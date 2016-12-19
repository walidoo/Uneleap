<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DB;
use Mail;


class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        $userId = \Auth::id();
        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'user_name' => 'sometimes|unique:users,user_name,' . $userId,
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'country' => 'required|string',
                    'gender' => 'required|string',
                    'university' => 'sometimes|string|max:100',
                    'university_id' => 'sometimes|string|max:100',
                    'degree' => 'sometimes|string|max:100',
                    'job_title' => 'sometimes|string|max:100',
                    'description' => 'sometimes|string|max:100',
                    'user_type' => 'required|integer|between:1,3',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        $universityName = $degreeName = null;

        $filters = ['user_name', 'user_type', 'name', 'email', 'password', 'country', 'gender', 'university_id', 'type', 'job_title', 'description', 'is_activated'];
        $filteredData = \App\Helpers\CommonFunction::filterDataFromRequest($data, $filters);
        if (!empty($data['university'])) {

            $universityName = \App\University::find($data['university'])->name;
            $filteredData['university_list_id'] = $data['university'];
        }
        if (!empty($data['degree'])) {

            $degreeName = \App\Course::find($data['degree'])->name;
            $filteredData['course_list_id'] = $data['degree'];
        }
        $filteredData['password'] = bcrypt($filteredData['password']);
        $filteredData['university'] = $universityName;
        $filteredData['degree'] = $degreeName;
        return User::create($filteredData);
    }

    public function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->passes()) {
            $user = $this->create($input)->toArray();
            $user['link'] = str_random(30);

            DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);

            Mail::send('email.activation', $user, function($message) use ($user) {
                $message->to($user['email']);
                $message->subject('UneLeap - Activation Code');
            });

            return redirect()->to('login')
                ->with('success',"We sent activation code. Please check your mail.");
        }

        return back()->with('errors',$validator->errors());
    }


    /**
     * Check for user Activation Code
     *
     * @param  array  $data
     * @return User
     */
    public function userActivation($token)
    {
        $check = DB::table('user_activations')->where('token',$token)->first();

        if(!is_null($check)){
            $user = User::find($check->id_user);

            if($user->is_activated == 1){
                return redirect()->to('login')
                    ->with('success',"user are already actived.");                
            }

            $user->update(['is_activated' => 1]);
            DB::table('user_activations')->where('token',$token)->delete();

            return redirect()->to('login')
                ->with('success',"user active successfully.");
        }

        return redirect()->to('login')
                ->with('warning',"your token is invalid.");
    }
}
