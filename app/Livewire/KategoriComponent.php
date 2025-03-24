<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kategori;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class KategoriComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama, $id, $deskripsi, $cari;
    public function render()
    {
        if ($this->cari!=""){
            $data['kategori'] = Kategori::where('nama', 'like', '%'.$this->cari.'%')->paginate(5);
        }else{
            $data['kategori'] = Kategori::paginate(5);
        }
        $layout['title'] = 'Kelola Kategori Buku';
        return view('livewire.kategori-component', $data)->layoutData($layout);
    }

    public function store(){
        $this->validate([
            'nama'=>'required',
            'deskripsi'=>'required'
        ],[
            'nama.required'=>'Nama kategori harus diisi',
            'deskripsi.required'=>'Deskripsi kategori harus diisi'
        ]);

        Kategori::create([
            'nama'=>$this->nama,
            'deskripsi'=>$this->deskripsi
        ]);

        $this->reset();

        session()->flash('success','Data Kategori Berhasil Ditambahkan!');
        return redirect()->route('kategori');

    }

    public function edit($id){
        $kategori= Kategori::find($id);
        $this->id = $kategori->id;
        $this->nama = $kategori->nama;
        $this->deskripsi = $kategori->deskripsi;
    }

    public function update(){
        $kategori = Kategori::find($this->id);
        $kategori->update([
            'nama'=>$this->nama,
            'deskripsi'=>$this->deskripsi
        ]);

        $this->reset();

        session()->flash('success','Data Kategori Berhasil Diubah!');
        return redirect()->route('kategori');
    }

    public function confirm($id){
        $this->id = $id;
    }

    public function destroy(){
        $kategori = Kategori::find($this->id);
        $kategori->delete();

        $this->reset();
        
        session()->flash('success','Data Kategori Berhasil Dihapus!');
        return redirect()->route('kategori');
    }

}
