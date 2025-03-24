<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginComponent extends Component
{
    public $email, $password;

    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.login');
    }

    public function proses()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password minimal 6 karakter!'
        ]);

        $user = User::where('email', $this->email)->first();

        if (!$user) {

            $user = User::create([
                'nama' => 'User Baru',
                'alamat' => '-',
                'telepon' => '-',
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'jenis' => 'member',
            ]);
        }

        
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Password salah!',
        ])->onlyInput('email');
    }

    public function keluar()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
