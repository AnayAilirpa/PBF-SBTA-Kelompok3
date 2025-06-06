<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{

     private function checkRole(){
        $role = session('role');
        if($role !== 'admin' && $role !=='mahasiswa'){
            abort(403, 'Unauthorized action');
        }
    }

   public function mahasiswa(){//Menampilkan Data Mahasiswa
    $role = session('role');
    $npm = session('npm');

      $response = Http :: get('http://localhost:8080/Mahasiswa');
      $mahasiswa = $response->json();
      return view('Mahasiswa.mahasiswa', compact('mahasiswa', 'role'));

      if ($role === 'mahasiswa') {
            $mahasiswa = array_filter($mahasiswa, function ($mhs) use ($npm) {
                return isset($mhs['npm']) && $mhs['npm'] === $npm;
            });
            $mahasiswa = array_values($mahasiswa); 
        }

    return view('Mahasiswa.mahasiswa', compact('mahasiswa', 'role'));
  }

   public function create(){//Tambah data mahasiswa
     $this->checkRole();
     $role = session('role');
     
      $mahasiswa = Mahasiswa::all();
      return view('Mahasiswa.create', ['mahasiswa' => $mahasiswa]);
  }

  public function store(Request $request){
     $this->checkRole();
   $response = Http :: post('http://localhost:8080/Mahasiswa', [
      'npm'=> $request->npm,
      'nama'=> $request->nama,
      'angkatan'=> $request->angkatan,
      'email'=> $request->email,
      'no_telp'=> $request->no_telp,
  ]);
  if ($response->successful()){
   $data = $response->json();
   return redirect()->route('mahasiswa.mahasiswa')->with('Berhasil', 'Data Berhasil Disimpan');
  }else{
  return redirect()->route('mahasiswa.mahasiswa')->with('eror', 'Gagal Menyimpan');
}
  }


  public function destroy($npm)
  {
     $this->checkRole();
      $mahasiswa = Mahasiswa::where('npm', $npm)->first();
      if ($mahasiswa) {
          $mahasiswa->delete();
          return redirect()->route('mahasiswa.mahasiswa')->with('success', 'Data berhasil dihapus');
      }
      return redirect()->route('mahasiswa.mahasiswa')->with('error', 'Data tidak ditemukan');
  }

public function edit($npm)
    {
         $this->checkRole();
        $response = Http::get("http://localhost:8080/Mahasiswa/{$npm}");
        $mahasiswa = $response->json();
        $mahasiswa = is_array($mahasiswa) && isset($mahasiswa[0]) ? $mahasiswa[0] : $mahasiswa;
        return view('Mahasiswa.edit', compact('mahasiswa'));
    }

public function update(Request $request, $npm) {
     $this->checkRole();
    $response = Http::put("http://localhost:8080/Mahasiswa/{$npm}", [
        'npm' => $request->npm,
        'nama' => $request->nama,
        'angkatan' => $request->angkatan,
        'email' => $request->email,
        'no_telp' => $request->no_telp,
    ]);
   
    if ($response->successful()) {
        return redirect()->route('mahasiswa.mahasiswa')->with('success', 'Data berhasil diupdate');
    } else {
        return redirect()->route('mahasiswa.mahasiswa')->with('error', 'Gagal mengupdate data');
    }
}

}
