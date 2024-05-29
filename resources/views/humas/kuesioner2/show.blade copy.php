@extends('layouts.index-bkk')
@section('content')
    <h1>{{ $kuesioner->judul_kuesioner }}</h1>
    <p>{{ $kuesioner->deskripsi_kuesioner }}</p>

    <form action="{{ route('jawaban-store') }}" method="POST">
        @csrf
        @foreach ($pertanyaan as $pert)
            <div class="form-group">
                <label for="pertanyaan{{ $pert->id_pertanyaan }}">{{ $pert->pertanyaan }}</label>
                <input type="hidden" name="id_pertanyaan[]" value="{{ $pert->id_pertanyaan }}">
                <input type="text" class="form-control" name="jawaban[]" id="pertanyaan{{ $pert->id_pertanyaan }}" required>
            </div>
        @endforeach

        @foreach ($pertanyaan as $pert)
            <div class="row input_row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Pertanyaan {{ $pert + 1 }}</label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            {{ $pert->pertanyaan }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row input_row">
                <div class="col-md-12">
                    <div class='form-group'>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">
                            @if ($question->type == 'answer')
                                Answer
                            @else
                                Option
                            @endif
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            @if ($question->type == 'choice')
                                <div class="radio">
                                    <label>
                                        @foreach ($question->options as $opt_key => $option)
                                            <input type="radio" value="{{ $option->id }}" name="{{ $question->id }}">
                                            {{ $option->option }} &nbsp; &nbsp;
                                        @endforeach
                                    </label>
                                </div>
                            @elseif ($question->type == 'checkbox')
                                <div class="checkbox">
                                    <label>
                                        @foreach ($question->options as $opt_key => $option)
                                            <input type="checkbox" value="{{ $option->id }}"
                                                name="{{ $question->id }}[{{ $opt_key }}]"> {{ $option->option }}
                                            &nbsp; &nbsp;
                                        @endforeach
                                    </label>
                                </div>
                            @elseif ($question->type == 'answer')
                                <textarea aria-rowspan="3" aria-colspan="12" name="{{ $question->id }}"></textarea>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
        <input type="hidden" name="nisn" value="{{ auth()->user()->nisn }}">
        <input type="hidden" name="id_tahun_lulus" value="{{ auth()->user()->id_tahun_lulus }}">
        <input type="hidden" name="id_kategori" value="{{ auth()->user()->id_kategori }}">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
