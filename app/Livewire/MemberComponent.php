<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class MemberComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';
    public $nama, $alamat, $telepon, $email, $password, $cari, $id;
    public function render()
    {
        if($this->cari!=""){
            $data['member'] = User::where('nama', 'like', '%'.$this->cari.'%')
            ->orWhere('email', 'like', '%'.$this->cari.'%')
            ->paginate(5);
        }else{
            $data['member'] = User::where('jenis', 'member')->paginate(5);

        }

        $layout['title'] = 'Kelola Member';
        return view('livewire.member-component', $data)->layoutData($layout);
    }

    public function store(){
        $this->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'telepon'=>'required',
            'email'=>'required|email',

        ],[
            'nama.required'=>'Nama Tidak Boleh Kosong!',
            'alamat.required'=>'Alamat Tidak Boleh Kosong!',
            'telepon.required'=>'Telepon Tidak Boleh Kosong!',
            'email.required'=>'Email Tidak Boleh Kosong!',
            'email.email'=>'Format Email Tidak Valid!',

        ]);

        User::create([
            'nama'=>$this->nama,
            'alamat'=>$this->alamat,
            'telepon'=>$this->telepon,
            'email'=>$this->email,
            'jenis'=>'member'
        ]);

        session()->flash('success','Member Berhasil Ditambahkan!');
        return redirect()->route('member');
    }

    public function edit($id){
        $member = User::find($id);
        $this->id=$member->id;
        $this->nama=$member->nama;
        $this->alamat=$member->alamat;
        $this->telepon=$member->telepon;
        $this->email=$member->email;
    }

    public function update(){
        $member = User::find($this->id);
        $member->update([
            'nama'=>$this->nama,
            'alamat'=>$this->alamat,
            'telepon'=>$this->telepon,
            'email'=>$this->email
        ]);
        
        $this ->reset();

        session()->flash('success','Member Berhasil Diubah!');
        return redirect()->route('member');
    }

    public function confirm($id){
        $this->id = $id;
    }

    public function destroy(){
        $member = User::find($this->id);
        $member->delete();
        session()->flash('success','Data Member Berhasil Dihapus!');
        return redirect()->route('member');
    }
}

