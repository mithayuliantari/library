<div>
    <div class="card">
        <div class="card-header">
          Pengembalian Buku
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                 </div>
            @endif



            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Buku</th>
                        <th scope="col">Member</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th>Proses</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pinjam as $data)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{ $data->buku->judul }}</td>
                                <td>{{ $data->user->nama }}</td>
                                <td>{{ $data->tanggal_pinjam }}</td>
                                <td>{{ $data->tanggal_kembali }}</td>


                                <td>
                                    <a href="#" wire:click="pilih({{$data->id}})" class="btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#pilih">Pilih</a>
                                    {{-- <a href="#" wire:click="edit({{$data->id}})" class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#editPage">Edit</a>

                                    <a href="#" wire:click="confirm({{$data->id}})" class="btn btn-sm btn-danger"  data-toggle="modal"
                                    data-target="#deletePage">Hapus</a> --}}

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $pinjam->links() }}
            </div>

        </div>
    </div>


    <div class="card">
        <div class="card-header">
          Histori Buku Kembali
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                 </div>
            @endif



            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID Pinjam</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col">Denda</th>
                    </tr>

                    </thead>
                    <tbody>
                        @foreach ($pengembalian as $data)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{ $data->pinjam?->id ?? 'Data Tidak Ada' }}</td>

                                <td>{{ $data->tanggal_pengembalian }}</td>
                                <td>{{ $data->Denda }}</td>
                        @endforeach

                    </tbody>
                </table>
                {{ $pengembalian->links() }}
            </div>

        </div>
    </div>


    {{-- modal tambah data --}}
    <div wire:ignore.self class="modal fade" id="pilih" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Form Pengembalian</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        Judul Buku
                    </div>
                    <div class="col-md-8">
                        : {{$judul}}

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        Member
                    </div>
                    <div class="col-md-8">
                        : {{$member}}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        Tanggal Kembali
                    </div>
                    <div class="col-md-8">
                        : {{$tanggal_kembali}}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        Tanggal Hari Ini

                    </div>
                    <div class="col-md-8">
                        : {{date('Y-m-d');}}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        Denda
                    </div>
                    <div class="col-md-8">
                        : @if ($this->status==true)
                            Ya

                        @else
                            Tidak

                        @endif

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        @if ($this->status == true)
                            Lama Terlambat
                        @else
                            Sisa Waktu
                        @endif
                    </div>
                    <div class="col-md-8">
                        : {{ $lama }} Hari
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        Jumlah Denda
                    </div>
                    <div class="col-md-8">
                        : @if ($this->status==true)
                            Rp. {{$lama * 1000}}

                        @else
                            Rp. {{$lama * 0}}

                        @endif

                    </div>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="button" wire:click="store" class="btn btn-primary"
              >Simpan</button>
            </div>
          </div>
        </div>
    </div>


</div>
