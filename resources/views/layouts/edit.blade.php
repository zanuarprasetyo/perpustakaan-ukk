<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard|PERPUSWEB</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.inc_admin.navbar')
        <!-- main sidebar container -->
        @include('layouts.inc_admin.sidebar')

        <div class="content-wrapper">
            <div class="content-header">`
                <div class="container-fluid mb-2">
                    <h1 class="m-0">Form Data</h1>

                </div>
            </div>

            <form action=" {{ route('buku.update', $buku->id) }} " method="POST" enctype="multipart/form-data">
                @csrf
                <!-- @method('PATCH') -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <p>Judul</p>
                                <input type="text" class="form-control" id="judul" name="judul" required
                                    value="{{ $buku->judul }}">

                                <p class="mt-2">Penulis</p>
                                <input type="text" class="form-control" id="penulis" name="penulis" required
                                    value="{{ $buku->penulis }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mt-2">Penerbit</p>
                                        <input type="text" class="form-control" id="penerbit" name="penerbit"
                                            required value="{{ $buku->penerbit }}">
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mt-2">Tahun Terbit</p>
                                        <input type="number" class="form-control text-left" id="tahun_terbit"
                                            name="tahun_terbit" required value="{{ $buku->tahun_terbit }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="mt-2">Gambar</p>
                                    <img src="{{ asset('images/books/' . $buku->foto) }}" alt="Gambar Buku"
                                        class="col-12" style="max-width: 10vw">
                                    @if (!$buku->foto)
                                        <input type="file" class="form-control" id="foto" name="foto"
                                            class="col-12" required>
                                    @endif
                                </div>



                                <div class="row">
                                    <p class="mt-2">Stok</p>
                                    <input type="text" class="form-control" id="stok" name="stok" required
                                        value="{{ $buku->stok }}">
                                </div>
                                <div class="class">
                                    <p class="mt-2">Kategori</p>
                                    <select name="kategori[]" id="kategori" required multiple class="form-control">
                                        @php
                                            $selected = false;
                                        @endphp
                                        @foreach ($kategoribuku as $kategori)
                                            @foreach ($kategoribukurelasi as $kbr)
                                                @if ($kbr->kategori_id == $kategori->id)
                                                    @php
                                                        $selected = true;
                                                    @endphp
                                                    <option value="{{ $kategori->id }}" selected>
                                                        {{ $kategori->nama_kategori }}</option>
                                                @endif
                                            @endforeach
                                            @if ($selected == false)
                                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>


                                <div class="modal-footer justify-content-between">
                                    <div class="ml-2 text-left mt-3 mb-0">
                                        <a href="{{ '../tabel1' }}" class="btn btn-danger">
                                            Kembali
                                        </a>
                                    </div>
                                    <div class="mr-2 text-right mt-3 mb-0">
                                        <button type="submit" class="btn btn-success">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        <aside class="control-sidebar control-sidebar-dark">

            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Version 1.0.1
            </div>

            <strong>Copyright &copy; 2024 </strong> All rights reserved.
        </footer>
    </div>

    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/adminlte/dist/js/adminlte.min.js?v=3.2.0"></script>
    <script src="/adminlte/plugins/select2/js/select2.min.js"></script>
    <script>
        $("#kategori").select2({});
    </script>
    <script>
        // Function to check file extension
        function checkFileExtension() {
            var fileName = document.getElementById("foto").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile != "jpg" && extFile != "jpeg" && extFile != "png" && extFile != "gif" && extFile != "svg") {
                $('#warningModal').modal('show'); // Show warning modal if file extension is not allowed
                document.getElementById("foto").value = ""; // Clear file input field
            }
        }

        // Add event listener to input file element
        document.getElementById("foto").addEventListener("change", checkFileExtension);
    </script>

    <!-- Tambahkan modal warning -->
    <div class="modal fade" id="modalWarning" tabindex="-1" role="dialog" aria-labelledby="modalWarningLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalWarningLabel">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    DATA STOK TIDAK DAPAT MINUS
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan skrip JavaScript -->
    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                var stokValue = parseInt($('#stok').val());
                if (stokValue < 0) {
                    $('#modalWarning').modal('show');
                    event.preventDefault(); // Menghentikan pengiriman formulir jika stok negatif
                }
            });
        });
    </script>



    <!-- Modal Warning -->
    <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warningModalLabel">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    FILE GAMBAR YANG DITAMBAHKAN KURANG TEPAT. Silakan unggah file gambar dengan format yang benar
                    (jpeg, png, jpg, gif, svg).
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
