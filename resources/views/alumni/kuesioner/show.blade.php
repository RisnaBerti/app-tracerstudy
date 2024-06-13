<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    .text-underline {
        text-decoration: underline;
    }
</style>

@extends('layouts.index-alumni')
@section('content')
    <div class="container mt-4">
        <h1 class="h3 mb-2 text-gray-800">{{ $kuesioner->judul_kuesioner }}</h1>
        <hr>
        <a href="{{ url('kuesioner-alumni') }}" class="btn btn-dark btn-sm btn-icon-split mb-3">
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
                {{-- id_kuesioner --}}
                <input type="hidden" name="id_kuesioner" value="{{ $kuesioner->id_kuesioner }}">
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
                                <td>{{ $kuesioner->tahun_lulus_awal. ' - ' .$kuesioner->tahun_lulus_akhir }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                @if (Auth::user()->id_role == 4)
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
                                    <td>{{ $alumni->jurusan->nama_jurusan }}
                                    </td>
                                    <td>
                                        <span class="badge badge-success">{{ $alumni->tahun_lulus->tahun_lulus }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">{{ $alumni->kategori->nama_kategori }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <form action="{{ route('kuesioner-alumni-save') }}" method="POST" id="kuesioner-form">
            @csrf
            @php $counter = 0; @endphp
        
            <input type="hidden" name="nisn" value="{{ Auth::user()->username }}">
            <input type="hidden" name="id_tahun_lulus" value="{{ $alumni->id_tahun_lulus }}">
        
            <div class="card shadow mb-4">
                <div class="card-body">
                    <label for="id_kategori">Kegiatan anda sekarang?</label>
                    <select name="id_kategori" id="id_kategori" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id_kategori }}"
                                {{ $alumni->id_kategori == $category->id_kategori ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        
            <div id="question-section">
                @foreach ($groupedQuestions as $categoryId => $questions)
                    <div class="category-questions" id="category-{{ $categoryId }}" style="display: none;">
                        <h5 class="font-weight-bold text-primary">{{ $categories->find($categoryId)->nama_kategori }}</h5>
                        @foreach ($questions as $key => $pertanyaan)
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-dark">
                                        {{ $key + 1 . '. ' . $pertanyaan->pertanyaan }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if ($pertanyaan->tipe_pertanyaan === 'Pilihan')
                                        @php $counter++ @endphp
                                        <ul class="list-group text-dark">
                                            @foreach ($pertanyaan->opsiJawaban as $jawaban)
                                                <label for="jawaban-{{ $jawaban->id_opsi }}">
                                                    <li class="list-group-item">
                                                        <input type="radio"
                                                            name="respons[{{ $counter }}][jawaban]"
                                                            id="jawaban-{{ $jawaban->id_opsi }}"
                                                            value="{{ $jawaban->opsi }}" class="mr-2">
                                                        {{ $jawaban->opsi }}
                                                        <input type="hidden" name="respons[{{ $counter }}][id_pertanyaan]" value="{{ $pertanyaan->id_pertanyaan }}">
                                                        <input type="hidden" name="respons[{{ $counter }}][id_kategori]" value="{{ $categoryId }}">
                                                    </li>
                                                </label>
                                            @endforeach
                                        </ul>
                                    @elseif($pertanyaan->tipe_pertanyaan === 'Textarea')
                                        @php $counter++ @endphp
                                        <textarea class="form-control" id="jawaban" placeholder="Jawaban anda..."
                                            name="respons[{{ $counter }}][jawaban]" rows="3"></textarea>
                                        <input type="hidden" name="respons[{{ $counter }}][id_pertanyaan]" value="{{ $pertanyaan->id_pertanyaan }}">
                                        <input type="hidden" name="respons[{{ $counter }}][id_kategori]" value="{{ $categoryId }}">
                                    @elseif($pertanyaan->tipe_pertanyaan === 'Text')
                                        @php $counter++ @endphp
                                        <input type="text" name="respons[{{ $counter }}][jawaban]" placeholder="Jawaban anda..." class="form-control">
                                        <input type="hidden" name="respons[{{ $counter }}][id_pertanyaan]" value="{{ $pertanyaan->id_pertanyaan }}">
                                        <input type="hidden" name="respons[{{ $counter }}][id_kategori]" value="{{ $categoryId }}">
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
                        @foreach ($groupedQuestions as $categoryId => $questions)
                            <a class="list-group-item list-group-item-action category-tab @if ($loop->first) active @endif"
                                id="category-{{ $categoryId }}-list" data-toggle="list"
                                href="#category-{{ $categoryId }}" role="tab"
                                aria-controls="{{ $categoryId }}">{{ $categories->find($categoryId)->nama_kategori }}</a>
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
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const selectKategori = document.getElementById('id_kategori');
        
                selectKategori.addEventListener('change', function () {
                    const selectedCategory = this.value;
                    document.querySelectorAll('.category-questions').forEach(function (category) {
                        category.style.display = 'none';
                    });
                    if (selectedCategory) {
                        const selectedCategoryElement = document.getElementById('category-' + selectedCategory);
                        selectedCategoryElement.style.display = 'block';
                    }
                });
        
                // Trigger change event to show the initial selected category if any
                selectKategori.dispatchEvent(new Event('change'));
            });
        </script>
        
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
