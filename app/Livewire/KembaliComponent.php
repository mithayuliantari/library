<?php

namespace App\Livewire;

use App\Models\Pengembalian;
use DateTime;
use App\Models\Pinjam;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class KembaliComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $id, $judul, $member, $tanggal_kembali, $selisih, $status, $lama;
    public function render()
    {
        $layout['title'] = 'Pengembalian Buku';
        $data['pinjam'] = Pinjam::where('status', 'pinjam')->paginate(10);
        $data['pengembalian'] = Pengembalian::paginate(5);
        return view('livewire.kembali-component', $data)->layoutData($layout);
    }

    public function pilih($id){
        $pinjam=Pinjam::find($id);
        $this->judul = $pinjam->buku->judul;
        $this->member = $pinjam->user->nama;
        $this->tanggal_kembali = $pinjam->tanggal_kembali;
        $this->id = $pinjam->id;

        $kembali = new DateTime($this->tanggal_kembali) ;
        $today = new DateTime();
        $selisih= $today->diff($kembali);
        // $this->status= $selisih->invert;
        if($selisih->invert == 1){
            $this->status = true;
        } else {
            $this->status = false;
        }
        $this->lama = $selisih->d;
    }

    public function store(){
        if ($this->status == true) {
            $denda = $this->lama * 1000;
        } else {
            $denda = 0;
        }

        $pinjam = Pinjam::find($this->id);
        Pengembalian::create([
            'pinjam_id' => $this->id,
            'tanggal_pengembalian' => date('Y-m-d'),
            'denda' => $denda
        ]);
        $pinjam->update([
            'status' => 'kembali'
        ]);

        $this->reset();
        session()->flash('success', 'Pengembalian Buku Berhasil!');
        return redirect(route('kembali'));
    }
}
