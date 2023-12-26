@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Detail Data
                </h4>
            </div>

            <div class="card-body">
                <div class="mb-1">
                    <a href="/admin/dokter">
                        <button class="btn btn-gradient-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>
                    </a>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Poli
                    </label>

                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ $doctor->poli->name }}" placeholder="Masukan Nama Poli" autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Nama
                    </label>

                    <input type="text" class="form-control" name="name" id="name" value="{{ $doctor->name }}"
                        placeholder="Masukan Nama" autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="address">
                        Alamat
                    </label>

                    <textarea class="form-control" name="address" id="address" placeholder="Masukan Alamat" cols="30" rows="5"
                        readonly>{{ $doctor->address }}</textarea>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="phone_number">
                        Nomor HP
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            62
                        </span>

                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            value="{{ $doctor->phone_number }}" placeholder="Masukan Nomor HP" autocomplete="off" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
