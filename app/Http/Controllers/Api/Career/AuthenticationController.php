<?php
namespace App\Http\Controllers\Api\Career;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Candidate;
use App\Mail\WelcomeEmail;
use App\Models\PasswordReset;
use App\Mail\ConfirmationEmail;
use App\Mail\ResetPasswordEmail;
use App\Mail\ForgotPasswordEmail;
use App\Models\EmailVerification;
use App\Http\Requests\EmailRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Requests\EmailVerificationRequest;

class AuthenticationController extends ServiceController
{
     /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function signup(SignupRequest $request)
    {
        $validated = $request->validated();
        try {
            $validated['password'] = Hash::make($validated['password']);
            $validated['email'] = strtolower($validated['email']);
            $validated['username'] = $validated['email'];
            $validated['reset_login'] = false;
            $validated['first_login'] = true;
            $validated['is_active'] = true;

            $user = Candidate::create($validated);

            // generate email verification token
            // $confirmation_token = mt_rand(100000, 999999);
            $confirmation_token = uniqid();

            // persist email verification token
            EmailVerification::updateOrCreate(
                ['email' => $validated["email"]],
                [
                    'token' => bcrypt($confirmation_token),
                    'expires_at' => Carbon::now()->addHours(1)
                ]
            );

            $url = ENV('FRONTEND_URL') . 'email-confirmation?token=' . $confirmation_token . '&email=' . $validated['email'];

            // Send verification mail
            try {
                Mail::to($validated["email"])->queue(new ConfirmationEmail($user, $url));
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            $message = "User successfully created and an email verification mail has been sent to the user's registered mail";
            return $this->created($user, $message);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\EmailRequest $request
     * @return \Illuminate\Http\Response
     */
    public function resendConfirmation(EmailRequest $request)
    {
        $validated = $request->validated();
        try
        {
            // Get user details
            $user = Candidate::where('email', $validated['email'])->first();
            if(!$user)
            {
                $message = "The supplied email was not found";
                return $this->not_found(null, $message);
            }

            if($user->email_verified == true)
            {
                $status = 'already_verified';
                return $this->bad_request(null, null, $status);
            }

            // generate email verification token
            // $confirmation_token = mt_rand(100000, 999999);
            $confirmation_token = uniqid();

            // persist email verification token
            EmailVerification::updateOrCreate(
                ['email' => $validated["email"]],
                [
                    'token' => bcrypt($confirmation_token),
                    'expires_at' => Carbon::now()->addHours(1)
                ]
            );

            $url = ENV('FRONTEND_URL') . 'email-confirmation?token=' . $confirmation_token . '&email=' . $validated['email'];

            // Send verification mail
            try {
                Mail::to($validated["email"])->queue(new ConfirmationEmail($user, $url));
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            $message = "Verification mail has been resent to user's registered mail";
            return $this->success($user, $message);
        }
        catch (\Throwable $ex)
        {
            return $this->server_error($ex);
        }
    }

    /**
     * @param \App\Http\Requests\EmailVerificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function confirmation(EmailVerificationRequest $request)
    {
        try
        {
            $data = $request->validated();

            // get verification details details
            $verification = EmailVerification::where('email', $data['email'])->first();

            // validate verification token
            if(!$verification || !Hash::check($data["token"], $verification->token))
            {
                $status = 'invalid_token';
                return $this->bad_request(null, null, $status);
            }

            // validate token lifespan
            if(Carbon::now()->gt($verification->expires_at))
            {
                $status = 'expired_token';
                return $this->bad_request(null, null, $status);
            }

            // Get user details
            $user = Candidate::where('email', $verification->email)->first();
            if(!$user)
            {
                return $this->not_found();
            }

            // verify user
            $user->email_verified = true;
            $user->email_verified_at = Carbon::now();
            $user->save();

            $verification->delete();

            // generate access token
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            $url = ENV('FRONTEND_URL') . '/dashboard';

            // send welcome mail
            try {
                Mail::to($user->email)->queue(new WelcomeEmail($user, $url));
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            $response['user'] = $user;
            $response['token'] = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer Token',
                'expires' => Carbon::parse($token->expires_at)->toDateTimeString(),
            ];
            return $this->success($response);
        }
        catch (\Throwable $ex)
        {
            return $this->server_error($ex);
        }
    }

    /**
     * @param \App\Http\Requests\SigninRequest $request
     * @return \Illuminate\Http\Response
     */
    public function signin(SigninRequest $request)
    {
        $data = $request->validated();
        try {
            $credentials = request(['email', 'password']);            
            
            // Check credentials
            if (!Auth::guard('web-career')->attempt($credentials))
            {
                $status = 'invalid_credentials';
                return $this->unauthorised(null, null, $status);
            }

            $user = Auth::guard('web-career')->user();

            // if the account is not active or functional
            // if($user->is_active != true) {
            //     $message = 'This account has been deactivated please contact your admin';
            //     return $this->forbidden(null, $message);
            // }

            // Set authentication token
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addCenturies(1);
            }

            $token->save();

            $user->last_login = Carbon::now();
            $user->save();

            $user->load('city', 'industry', 'jobFunction');

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
     * @param \Illuminate\Http\EmailRequest $request
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(EmailRequest $request)
    {
        $data = $request->validated();
        try
        {
            // Get user details
            $user = Candidate::where('email', $data['email'])->first();
            if(!$user)
            {
                return $this->not_found();
            }

            // generate email verification token
            // $confirmation_token = mt_rand(100000, 999999);
            $reset_token = uniqid();

            // persist email verification token
            PasswordReset::updateOrCreate(
                ['email' => $data["email"]],
                [
                    'token' => bcrypt($reset_token),
                    'expires_at' => Carbon::now()->addHours(1)
                ]
            );

            $url = ENV('FRONTEND_URL') . 'reset-password?token=' . $reset_token . '&email=' . $data['email'];

            // Send verification mail
            try {
                Mail::to($data["email"])->queue(new ForgotPasswordEmail($user, $url, null));
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
            $user = Candidate::where('email', $data['email'])->first();
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
