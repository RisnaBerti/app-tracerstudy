<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    .text-underline {
        text-decoration: underline;
    }
</style>

@extends('layouts.index-bkk')
@section('content')
    <div class="container mt-4">
        <h1 class="h3 mb-2 text-gray-800">{{ $kuesioner->judul_kuesioner }}</h1>
        <hr>
        <a href="{{ url('kuesioner') }}" class="btn btn-dark btn-sm btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-primary">{{ $kuesioner->deskripsi_kuesioner }}</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h4 class="text-dark font-italic text-underline">{{ $kuesioner->judul_kuesioner }}</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered text-dark text-center">
                            <tr>
                                <th>Tanggal Kuesioner</th>
                                <th>Periode</th>
                            </tr>
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($kuesioner->tgl_kuesioner)->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($kuesioner->awal)->translatedFormat('d F Y') . ' - ' . \Carbon\Carbon::parse($kuesioner->akhir)->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                @if (Auth::user()->id_role == '4')
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered text-dark text-center">
                                <tr>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Status</th>
                                </tr>
                                <tr>
                                    <td>{{ $alumni->nama_alumni }}
                                    </td>
                                    <td>{{ $alumni->id_jurusan }}
                                    </td>
                                    <td>
                                        <span class="badge badge-success">{{ $alumni->id_tahun_lulus }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">{{ $alumni->id_kategori }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <form action="{{ route('kuesioner-alumni') }}" method="post">
            @csrf
            @php $counter = 0; @endphp

            <input type="hidden" name="nisn" value="{{ Auth::user()->username }}">
            {{-- <input type="hidden" name="id_kuesioner" value="{{ $kuesioner->id }}">
                <input type="hidden" name="id_tahun_lulus" value="{{ $id_tahun_lulus }}">
                <input type="hidden" name="id_kategori" value="{{ $id_kategori }}"> --}}

                <div class="tab-content" id="question-section">
                    @foreach ($groupedQuestions as $categoryId => $questions)
                        <div class="tab-pane fade" id="category-{{ $categoryId }}" role="tabpanel">
                            <h5 class="font-weight-bold text-primary">{{ $categories->find($categoryId)->nama_kategori }}</h5>
                            @foreach ($questions as $key => $pertanyaan)
                                <div class="card shadow mb-4 pertanyaan kategori-{{ $pertanyaan->id_kategori }}">
                                    <!-- Konten Pertanyaan -->
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

            <div class="tab-content" id="question-section">
                @foreach ($kuesioner->pertanyaan->chunk(5) as $chunk)
                    <div class="tab-pane fade @if ($loop->iteration === 1) show active @endif"
                        id="list-{{ $loop->iteration }}" role="tabpanel">
                        @foreach ($chunk as $key => $pertanyaan)
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-dark">
                                        {{ ($loop->parent->iteration - 1) * 5 + $loop->index + 1 . '. ' . $pertanyaan->pertanyaan }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if ($pertanyaan->tipe_pertanyaan === 'Pilihan')
                                        @php $counter++ @endphp
                                        <ul class="list-group text-dark">
                                            @foreach ($pertanyaan->opsiJawaban as $jawaban)
                                                <label for="jawaban-{{ $jawaban->id }}">
                                                    <li class="list-group-item">
                                                        <input type="radio" name="respons[{{ $counter }}][id_opsi]"
                                                            id="jawaban-{{ $jawaban->id_opsi }}"
                                                            value="{{ $jawaban->id_opsi }}" class="mr-2" required>
                                                        {{ $jawaban->opsi }}
                                                        <input type="hidden"
                                                            name="respons[{{ $counter }}][id_pertanyaan]"
                                                            value="{{ $pertanyaan->id_pertanyaan }}">
                                                    </li>
                                                </label>
                                            @endforeach
                                        </ul>
                                    @elseif($pertanyaan->tipe_pertanyaan === 'Textarea')
                                        @php $counter++ @endphp
                                        <textarea class="form-control" id="jawaban" placeholder="Jawaban anda..."
                                            name="respons[{{ $counter }}][jawaban]" rows="3" required></textarea>

                                        <input type="hidden" name="respons[{{ $counter }}][id_pertanyaan]"
                                            value="{{ $pertanyaan->id_pertanyaan }}">
                                    @elseif($pertanyaan->tipe_pertanyaan === 'Text')
                                        @php $counter++ @endphp
                                        <input type="text" name="respons[{{ $counter }}][jawaban]"
                                            placeholder="Jawaban anda..." class="form-control" required>
                                        <input type="hidden" name="respons[{{ $counter }}][id_pertanyaan]"
                                            value="{{ $pertanyaan->id_pertanyaan }}">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="d-flex mb-3">
                <div class="mr-auto p-2">
                    <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                        @foreach ($kuesioner->pertanyaan->chunk(5) as $chunk)
                            <a class="list-group-item list-group-item-action @if ($loop->iteration === 1) active @endif"
                                id="list-{{ $loop->iteration }}-list" data-toggle="list"
                                href="#list-{{ $loop->iteration }}" role="tab"
                                aria-controls="{{ $loop->iteration }}">{{ $loop->iteration }}</a>
                        @endforeach
                    </div>
                </div>
                @if ($kuesioner->pertanyaan->count())
                    <div class="p-2">
                        <button class="btn btn-primary btn-icon-split" type="submit">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Selesai</span>
                        </button>
                    </div>
                @else
                    <div class="p-2">
                        <button class="btn btn-danger btn-icon-split disabled" type="submit">
                            <span class="icon text-white-50">
                                <i class="fas fa-times"></i>
                            </span>
                            <span class="text">Belum Ada Pertanyaan</span>
                        </button>
                    </div>
                @endif
            </div>
        </form>

    </div>
@endsection
<script>
    // Ambil elemen select untuk kategori
    var selectKategori = document.getElementById('id_kategori');

    // Ambil semua elemen pertanyaan
    var pertanyaan = document.querySelectorAll('.pertanyaan');

    // Sembunyikan semua pertanyaan saat halaman dimuat
    pertanyaan.forEach(function(item) {
        item.style.display = 'none';
    });

    // Tambahkan event listener untuk mengubah opsi kategori
    selectKategori.addEventListener('change', function() {
        // Ambil nilai kategori yang dipilih
        var selectedKategori = this.value;

        // Sembunyikan semua pertanyaan terlebih dahulu
        pertanyaan.forEach(function(item) {
            item.style.display = 'none';
        });

        // Tampilkan pertanyaan yang sesuai dengan kategori yang dipilih
        var pertanyaanKategori = document.querySelectorAll('.kategori-' + selectedKategori);
        pertanyaanKategori.forEach(function(item) {
            item.style.display = 'block';
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
