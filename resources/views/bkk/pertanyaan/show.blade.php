@extends('layouts.index-bkk')
@section('content')
    <h1>{{ $kuesioner->judul_kuesioner }}</h1>
    <p>{{ $kuesioner->deskripsi_kuesioner }}</p>

    <form action="{{ route('jawaban-store') }}" method="POST">
        @csrf
        @foreach($pertanyaan as $pert)
            <div class="form-group">
                <label for="pertanyaan{{ $pert->id_pertanyaan }}">{{ $pert->pertanyaan }}</label>
                <input type="hidden" name="id_pertanyaan[]" value="{{ $pert->id_pertanyaan }}">
                <input type="text" class="form-control" name="jawaban[]" id="pertanyaan{{ $pert->id_pertanyaan }}" required>
            </div>
        @endforeach
        <input type="hidden" name="nisn" value="{{ auth()->user()->nisn }}">
        <input type="hidden" name="id_tahun_lulus" value="{{ auth()->user()->id_tahun_lulus }}">
        <input type="hidden" name="id_kategori" value="{{ auth()->user()->id_kategori }}">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
