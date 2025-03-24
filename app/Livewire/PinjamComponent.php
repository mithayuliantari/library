<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class PinjamComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $id, $user, $buku, $tanggal_pinjam, $tanggal_kembali;
    public function render()
    {
        $data['member']= User::where('jenis', 'member')->get();
        $data['book']= Buku::all();
        $data['pinjam']= Pinjam::paginate(10);
        $layout['title']= 'Pinjam Buku';

        return view('livewire.pinjam-component', $data)->layoutData($layout);
    }

    public function store(){
        $this->validate([
            'buku'=>'required',
            'user'=>'required',
        ],[
            'buku.required'=>'Buku Harus Dipilih!',
            'user.required'=>'Member Harus Dipilih!'
        ]);

        $this->tanggal_pinjam = date('Y-m-d');
        $now = $this->tanggal_pinjam;
        $this->tanggal_kembali = date('Y-m-d', strtotime($now.' +7 days'));

        Pinjam::create([
            'user_id'=>$this->user,
            'buku_id'=>$this->buku,
            'tanggal_pinjam'=>$this->tanggal_pinjam,
            'tanggal_kembali'=>$this->tanggal_kembali,
            'status'=>'pinjam'
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Proses Data');
        return redirect()->route('pinjam');
    }

    public function edit($id){
        $pinjam=Pinjam::find($id);
        $this->id = $pinjam->id;
        $this->user = $pinjam->user_id;
        $this->buku = $pinjam->buku_id;
        $this->tanggal_pinjam=$pinjam->tanggal_pinjam;
        $this->tanggal_kembali=$pinjam->tanggal_kembali;

    }

    public function update(){
        $pinjam=Pinjam::find($this->id);
        $this->tanggal_pinjam = date('Y-m-d');
        $this->tanggal_kembali = date('Y-m-d', strtotime($this->tanggal_pinjam.' +7 days'));
        $pinjam->update([
            'user_id'=>$this->user,
            'buku_id'=>$this->buku,
            'tanggal_pinjam'=>$this->tanggal_pinjam,
            'tanggal_kembali'=>$this->tanggal_kembali,
            'status'=>'pinjam'

        ]);

        $this->reset();
        session()->flash('success', 'Data Peminjaman Berhasil Diubah');
        return redirect()->route('pinjam');
    }

    public function confirm($id){
        $this->id = $id;
    }

    public function destroy(){
        $pinjam = Pinjam::find($this->id);
        $pinjam->delete();
        $this->reset();
        session()->flash('success', 'Data Peminjaman Berhasil Dihapus');
        return redirect()->route('pinjam');
    }

}
