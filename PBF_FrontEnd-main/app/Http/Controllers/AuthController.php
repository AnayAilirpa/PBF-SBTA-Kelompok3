<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // tampilan form login
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Kirim request ke backend CI4
        $response = Http::post('http://localhost:8080/Login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json()['user'];

            // Simpan data user ke session
            Session::put('id_user', $data['id_user']);
            Session::put('username', $data['username']);
            Session::put('role', $data['role']);

            // Redirect berdasarkan role
            if ($data['role'] == 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($data['role'] == 'mahasiswa') {
                return redirect('/mahasiswa/dashboard');
            } elseif ($data['role'] == 'dosen') {
                return redirect('/dosen/dashboard');
            } else {
                return redirect('/login')->withErrors('Role tidak dikenali');
            }

        } else {
            return redirect()->back()->withErrors($response->json()['message']);
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
