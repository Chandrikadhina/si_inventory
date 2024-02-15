@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h2>EDIT JENIS</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kategori.update',$rsetKategori->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">KATEGORI</label>
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" value="{{ old('kategori',$rsetKategori->kategori) }}" placeh>

                                <!-- error message untuk kategori -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">JENIS</label>
                                <select class="form-control @error('jenis') is-invalid @enderror" name="jenis" aria-label="Default select example">
                                    <option value="blank" selected>Pilih jenis</option>
                                    <option value="M" @if(old('jenis', $rsetKategori->jenis) == 'M') selected @endif>Barang Modal</option>
                                    <option value="A" @if(old('jenis', $rsetKategori->jenis) == 'A') selected @endif>Alat</option>
                                    <option value="BHP" @if(old('jenis', $rsetKategori->jenis) == 'BHP') selected @endif>Bahan Habis Pakai</option>
                                    <option value="BTHP" @if(old('jenis', $rsetKategori->jenis) == 'BTHP') selected @endif>Bahan Tidak Habis Pakai</option>
                                </select>

                                <!-- error message for jenis -->
                                @error('jenis')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-primary">Back</a>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection