<?php

namespace App\Livewire;

use App\Models\Buku;
use Livewire\Component;
use App\Models\Kategori;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class BukuComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $kategori, $judul, $penulis, $penerbit, $isbn , $tahun, $jumlah, $id, $cari;
    public function render()
    {
        if($this->cari!=""){
            $data['buku'] = Buku::where('judul', 'like', '%'.$this->cari.'%')->paginate(5);
        } else{
            $data['buku'] = Buku::paginate(5);

        }

        $data['category'] = Kategori::all();
        $layout['title'] = 'Kelola Buku';
        return view('livewire.buku-component', $data)->layoutData($layout);
    }

    public function store(){
        $this->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'isbn' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required',
        ],[
            'judul.required'=>'Judul Tidak Boleh Kosong!',
            'kategori.required'=>'Kategori Tidak Boleh Kosong!',
            'penulis.required'=>'Penulis Tidak Boleh Kosong!',
            'penerbit.required'=>'Penerbit Tidak Boleh Kosong!',
            'isbn.required'=>'ISBN Tidak Boleh Kosong!',
            'tahun.required'=>'Tahun Tidak Boleh Kosong!',
            'jumlah.required'=>'Jumlah Tidak Boleh Kosong!',
        ]);

        Buku::create([
            'judul'=>$this->judul,
            'kategori_id'=>$this->kategori,
            'penulis'=>$this->penulis,
            'penerbit'=>$this->penerbit,
            'isbn'=>$this->isbn,
            'tahun'=>$this->tahun,
            'jumlah'=>$this->jumlah,
        ]);

        $this->reset();
        session()->flash('seccess', 'Buku Berhasil Ditambahkan!');
        return redirect()->route('buku');
    }


    public function edit($id){
        $buku = Buku::find($id);
        $this->id = $buku->id;
        $this->judul = $buku->judul;
        $this->kategori = $buku->kategori->id;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->isbn = $buku->isbn;
        $this->tahun = $buku->tahun;
        $this->jumlah = $buku->jumlah;
    }

    public function update(){
        $buku = Buku::find($this->id);
        $buku->update([
            'judul'=>$this->judul,
            'kategori_id'=>$this->kategori,
            'penulis'=>$this->penulis,
            'penerbit'=>$this->penerbit,
            'isbn'=>$this->isbn,
            'tahun'=>$this->tahun,
            'jumlah'=>$this->jumlah,

        ]);

        $this->reset();

        session()->flash('success', 'Buku Berhasil Di Edit!');
        return redirect ()->route('buku');
    }

    public function confirm($id){
        $this->id = $id;
    }

    public function destroy(){
        $buku = Buku::find($this->id);
        $buku->delete();
        session()->flash('success','Buku Berhasil Dihapus!');
        return redirect()->route('buku');
    }
}
