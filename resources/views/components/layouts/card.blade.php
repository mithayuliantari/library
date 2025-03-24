<div id="dashboard" class="mb-4">
    <h2>Overview</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">
                    <span data-feather="users" class="mr-2"></span> Anggota
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total: {{$member}}</h5>
                    <p class="card-text">Anggota Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    <span data-feather="book" class="mr-2"></span> Buku
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total: {{$buku}}</h5>
                    <p class="card-text">Buku yang Tersedia</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">
                    <span data-feather="file-text" class="mr-2"></span> Peminjaman
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total: {{$pinjam}}</h5>
                    <p class="card-text">Buku yang Dipinjam</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">
                    <span data-feather="clock" class="mr-2"></span> Pengembalian
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total: {{$kembali}}</h5>
                    <p class="card-text">Buku yang Dikembalikan</p>
                </div>
            </div>
        </div>
    </div>
</div>
