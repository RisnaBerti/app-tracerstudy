@extends('layouts.index-bkk')
@section('content')
    <h1>{{ $kuesioner->judul_kuesioner }}</h1>
    <p>{{ $kuesioner->deskripsi }}</p>

    <form action="{{ route('jawaban-store') }}" method="POST">
        @csrf
        @foreach($pertanyaan as $pert)
            <div class="form-group">
                <label for="pertanyaan{{ $pert->id_pertanyaan }}">{{ $pert->pertanyaan }}</label>
                <input type="hidden" name="id_pertanyaan[]" value="{{ $pert->id_pertanyaan }}">
                @if($pert->tipe_pertanyaan === 'pilihan ganda')
                    <select name="jawaban[]" id="pertanyaan{{ $pert->id_pertanyaan }}" class="form-control" required>
                        @foreach($pert->opsiJawaban as $opsi)
                            <option value="{{ $opsi->opsi }}">{{ $opsi->opsi }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="text" name="jawaban[]" id="pertanyaan{{ $pert->id_pertanyaan }}" class="form-control" required>
                @endif
            </div>
        @endforeach
        {{-- <input type="hidden" name="nisn" value="{{ auth()->user()->nisn }}"> --}}
        <input type="hidden" name="nisn" value="200102005">
        {{-- <input type="hidden" name="id_tahun_lulus" value="{{ auth()->user()->id_tahun_lulus }}"> --}}
        <input type="hidden" name="id_tahun_lulus" value="1">
        {{-- <input type="hidden" name="id_kategori" value="{{ auth()->user()->id_kategori }}"> --}}
        <input type="hidden" name="id_kategori" value="1">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
