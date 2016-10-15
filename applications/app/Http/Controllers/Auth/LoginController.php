<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Auth\Guard;
use Carbon\Carbon;
use Validator;

use Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
  	 * Handle a login request to the application.
  	 *
  	 * @param  App\Http\Requests\LoginRequest  $request
  	 * @param  Guard  $auth
  	 * @return Response
  	 */
  	public function postLogin(Request $request, Guard $auth)
  	{
      $message = [
        'username.required' => 'Fill This Field',
        'password.required' => 'Fill This Field'
      ];

      $validator = Validator::make($request->all(), [
        'username' => 'required',
        'password' => 'required',
      ], $message);

      if($validator->fails()) {
        return redirect()->route('index')->withErrors($validator)->withInput();
      }
  		$logValue = $request->input('username');

  		$logAccess = filter_var($logValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

  		$throttles = in_array(ThrottlesLogins::class, class_uses_recursive(get_class($this)));

  		if ($throttles && $this->hasTooManyLoginAttempts($request))
  		{
  			return redirect()->route('index')->with('error', 'You have reached the maximum number of login attempts. Try again in one minute.')->withInput($request->only('email'));
  		}

  		$credentials = [
  			$logAccess  => $logValue,
  			'password'  => $request->input('password')
  		];

  		if(!$auth->validate($credentials))
  		{
  			if ($throttles)
  			{
  			  $this->incrementLoginAttempts($request);
  			}
  			return redirect()->route('index')->with('error', 'These credentials do not match our records.')->withInput($request->only('email'));
  		}

  		$user = $auth->getLastAttempted();

  		if($user)
  		{
  			if ($throttles)
  			{
  				$this->clearLoginAttempts($request);
  			}

  			$auth->login($user, $request->has('memory'));
  			if($request->session()->has('user_id'))
  			{
  				$request->session()->forget('user_id');
  			}

  			return redirect()->route('dashboard');
  		}

  		$request->session()->put('user_id', $user->id);

      return redirect()->route('index');
  	}

    public function getLogout()
    {
      session()->flush();
      Auth::logout();
      return redirect()->route('index');
    }
}
