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
                    <a href="/admin/poli">
                        <button class="btn btn-gradient-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>
                    </a>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Nama
                    </label>

                    <input type="text" class="form-control" name="name" id="name" value="{{ $poli->name }}"
                        placeholder="Masukan Nama" autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="description">
                        Keterangan
                    </label>

                    <textarea class="form-control" name="description" id="description" placeholder="Masukan Keterangan" autocomplete="off"
                        cols="30" rows="5" readonly>{{ $poli->description }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
