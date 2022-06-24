<?php
namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\PasswordReset;
use App\Mail\ResetPasswordEmail;
use App\Mail\ForgotPasswordEmail;
use App\Http\Requests\EmailRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SigninRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PasswordResetRequest;

class AuthenticationController extends ServiceController
{
    public function signin(SigninRequest $request)
    {
        $data = $request->validated();
        try {
            $credentials = request(['email', 'password']);

            // Check credentials
            if (!Auth::attempt($credentials))
            {
                $status = 'invalid_credentials';
                return $this->unauthorised(null, null, $status);
            }

            $user = $request->user();

            // if the account is not active or functional
            if($user->is_active != true) {

                $message = 'This account has been deactivated please contact your admin';
                return $this->forbidden(null, $message);
            }

            // Set authentication token
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addCenturies(1);
            }

            $token->save();

            $user->last_login = Carbon::now();
            $user->save();

            $user->load('department', 'designation');
            
            $role = $user->roles()->first()->makeHidden(['pivot', 'user_id', 'created_at', 'updated_at']);
            $permissions = $role->permissions->makeHidden(['pivot', 'guard_name', 'group_id', 'created_at', 'updated_at'])->load('group');
            
            $user->role = $role->load('user');
            $role->permissions = $permissions;

            $response['user'] = $user;
            $response['access'] = [
                'token' => $tokenResult->accessToken,
                'type' => 'Bearer Token',
                'expires' => Carbon::parse($token->expires_at)->toDateTimeString(),
            ];
            return $this->success($response);

        } catch (\Throwable $ex) {
            return $this->server_error($ex);
        }
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(EmailRequest $request)
    {
        $data = $request->validated();
        try
        {
            // Get user details
            $user = User::where('email', $data['email'])->first();
            if(!$user)
            {
                return $this->not_found();
            }

            // generate email verification token
            $reset_token = mt_rand(100000, 999999);

            Log::alert($reset_token);

            // persist email verification token
            PasswordReset::updateOrCreate(
                ['email' => $data["email"]],
                [
                    'token' => bcrypt($reset_token),
                    'expires_at' => Carbon::now()->addHours(12)
                ]
            );

            // Send verification mail
            try {
                Mail::to($data["email"])->queue(new ForgotPasswordEmail($user, $reset_token, null));
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            return $this->success($user);
        }
        catch (\Throwable $ex)
        {
            return $this->server_error($ex);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(PasswordResetRequest $request)
    {
        $data = $request->validated();
        try
        {
            // Get user details
            $resetRequest = PasswordReset::where('email', $data['email'])->first();
            if(!$resetRequest)
            {
                $message = 'No password reset request found for this user';
                return $this->not_found(null, $message);
            }

            // Validate token
            if(!Hash::check($data["token"], $resetRequest->token))
            {
                $status = 'bad_request';
                $msg = 'Token supplied is invalid';
                return $this->bad_request(null, $msg, $status);
            }

            // Validate token lifespan
            if(Carbon::now()->gt($resetRequest->expires_at))
            {
                $status = 'expired_token';
                return $this->bad_request(null, null, $status);
            }

            // Update password
            $user = User::where('email', $data['email'])->first();
            $user->fill(['password' => bcrypt($data['password'])])->save();

            $resetRequest->delete();

            // send password reset notification            
            try {
                Mail::to($user->email)->queue(new ResetPasswordEmail($user));
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            return $this->success($user);
        }
        catch(\Throwable $ex)
        {
            return $this->server_error($ex);
        }
    }


}
