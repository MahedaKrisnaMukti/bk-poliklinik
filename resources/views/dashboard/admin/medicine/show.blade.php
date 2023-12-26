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
                    <a href="/admin/obat">
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

                    <input type="text" class="form-control" name="name" id="name" value="{{ $medicine->name }}"
                        placeholder="Masukan Nama" autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                        <label class="form-label" for="packaging">
                            Kemasan
                        </label>

                        <input type="text" class="form-control" name="name" id="name" value="{{ $medicine->packaging }}"
                        placeholder="Masukan Nama" autocomplete="off" readonly>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="price">
                            Harga
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">
                                Rp
                            </span>

                            <input type="text" class="form-control" name="price" id="price"
                                onkeypress="return inputNumber()" onkeyup="formatNumber(this)"
                                value="{{ FormatterCustom::formatNumber($medicine->price) }}" placeholder="Masukan Harga"
                                autocomplete="off" readonly>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
