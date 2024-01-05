@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Ubah Data
                </h4>
            </div>

            <div class="card-body">
                <div class="mb-1">
                    <a href="/dokter/riwayat-pasien">
                        <button class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>
                    </a>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="medicalRecordNumber">
                        Nomor RM
                    </label>

                    <input type="text" class="form-control" name="medicalRecordNumber" id="medicalRecordNumber"
                        value="{{ $poliRegister->patient->medical_record_number }}" placeholder="Masukan Nomor RM"
                        autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Nama
                    </label>

                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ $poliRegister->patient->name }}" placeholder="Masukan Nama" autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="complaint">
                        Keluhan
                    </label>

                    <textarea class="form-control" name="complaint" id="complaint" placeholder="Masukan Keluhan" autocomplete="off"
                        cols="30" rows="5" readonly>{{ $poliRegister->complaint }}</textarea>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="note">
                        Catatan
                    </label>

                    <textarea class="form-control" name="note" id="note" placeholder="Masukan Catatan" autocomplete="off"
                        cols="30" rows="5" readonly>{{ $checkup->note }}</textarea>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="fee">
                        Biaya
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            Rp
                        </span>

                        <input type="text" class="form-control" name="fee" id="fee"
                            value="{{ FormatterCustom::formatNumber($checkup->checkup_fee + $checkupDetail->medicine->price) }}"
                            onkeypress="return inputNumber()" placeholder="Masukan Biaya" autocomplete="off" readonly>
                    </div>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="poliRegisterDate">
                        Tanggal Periksa
                    </label>

                    <input type="text" class="form-control" name="poliRegisterDate" id="poliRegisterDate"
                        value="{{ FormatterCustom::formatDate($poliRegister->poli_register_date) }}"
                        placeholder="Masukan Tanggal Periksa" autocomplete="off" readonly>
                </div>
            </div>
        </div>

        <div class="mb-1">
            <div class="row">
                @foreach ($medicine as $row)
                    <div class="col-md-3">
                        <div class="card">
                            <img src="{{ $row->image_url }}" class="card-img-top card-image" loading="lazy">

                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ $row->name }}

                                    <br>

                                    @php
                                        $qty = 0;

                                        foreach ($cart as $rowCart) {
                                            if ($row->id == $rowCart['attributes']['id_original']) {
                                                $qty = $rowCart['quantity'];
                                            }
                                        }
                                    @endphp

                                    <input type="hidden" id="medicine{{ $row->id }}" value="{{ $qty }}">

                                    <span class="badge bg-success mt-1" id="medicine-text{{ $row->id }}">
                                        {{ $qty }}
                                    </span>
                                </h3>

                                <h4 class="card-text mb-1">
                                    {{ FormatterCustom::formatNumber($row->price, true) }}
                                </h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
