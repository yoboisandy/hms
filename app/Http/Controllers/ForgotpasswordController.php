<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteTokenJob;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Forgotpassword;

class ForgotpasswordController extends Controller
{

    public function email(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::select('id', 'email')->where('email', $data['email'])->first();
        // return $email->id;
        if (!empty($user)) {
            $token = strtoupper(Str::random(6));
            $forgot = Forgotpassword::create([
                'token' => $token,
                'email' => $data['email'],
                'user_id' => $user->id,
            ]);
            return response()->json($forgot);
        } else {
            return response()->json(['message' => 'Email not found !!!']);
        }
    }

    public function token(Request $request)
    {
        $data = $request->validate([
            'token' => ['required', 'exists:forgotpasswords,token'],
            'user_id' => ['exists:users,id']
        ]);

        $token = Forgotpassword::select('token')->where('user_id', $data['user_id'])->first();
        if ($token) {
            dispatch(new DeleteTokenJob())->delay(now()->addMinute());
        }
        if ($data['token'] == $token['token']) {
            return response()->json(['message' => 'Valid Token']);
        } else {
            return response()->json(['error' => 'Token is Invalid']);
        }


        // return $data['token'];
        // $token = Forgotpassword::select('token')->where('token', $data['token'])->first();
        // return $token;
        // if ($data['token'] == $token['token']) {
        //     $request->validate([
        //         'password' => ['required', 'min:8'],
        //     ]);

        //     $pass = $request->password;
        //     return $pass;
        // $u = [$pass['password'] = '$request->password'];

        // DB::transaction(function () use ($customer, $user, $pw) {
        // $customer->update($pw);
        // $user->update($pass);
        // });
        // return response()->json(['message' => 'token match']);
        // } else {
        //     return response()->json(['message' => 'token is invalid']);
        // }
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required']
        ]);

        $password = bcrypt($request->password);
        // $user = User::findOrFail($request->user_id);
        $user->update([
            'password' => $password,
        ]);

        return response()->json([
            "message" => "Password Updated Successfully"
        ]);
    }

    public function deleteToken(User $user)
    {
        $forgotpassword = Forgotpassword::where("user_id", $user->id)->first();
        $forgotpassword->delete();
        return response()->json([
            "message" => "Token Deleted Successfully"
        ]);
    }
}
