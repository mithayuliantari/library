<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';
    public $nama, $email, $password, $id, $cari;

    public function render()
    {
        $layout['title']='Kelola User';

        if($this->cari!=""){
            $data['user'] = User::where('nama', 'like', '%'.$this->cari.'%')
            ->orWhere('email', 'like', '%'.$this->cari.'%')
            ->paginate(5);

        } else{
            $data['user']= User::paginate(5);
        }

        return view('livewire.user-component', $data)->layoutData($layout);
    }

    // tambah data
    public function store (){
        $this->validate([
            'nama'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ],[
            'nama.required'=>'Nama Tidak Boleh Kosong!',
            'email.required'=>'Email Tidak Boleh Kosong!',
            'email.email'=>'Format Email Tidak Valid!',
            'password.required'=>'Password Tidak Boleh Kosong!'
        ]);

        User::create([
            'nama'=>$this->nama,
            'email'=>$this->email,
            'password'=>$this->password,
            'jenis'=>'admin'

        ]);

        session()->flash('success','User Berhasil Ditambahkan!');
        $this->reset();
    }


    // edit data
    public function edit($id){
        $user = User::find($id);
        $this->nama=$user->nama;
        $this->email=$user->email;
        $this->id=$user->id;
    }

    public function update()
    {
        $user = User::find($this->id);
        if($this->password==""){
            $user->update([
                'nama'=>$this->nama,
                'email'=>$this->email
            ]);

        }else{
            $user->update([
                'nama'=>$this->nama,
                'email'=>$this->email,
                'password'=>$this->password
            ]);
        }

        session()->flash('success','User Berhasil Diubah!');
        $this->reset();
    }

    // hapus data
    public function confirm($id){
        $this->id = $id;
    }

    //method destroy
    public function destroy(){
        $user = User::find($this->id);
        $user->delete();
        session()->flash('success','Data User Berhasil Dihapus!');
        $this->reset();
    }

}
