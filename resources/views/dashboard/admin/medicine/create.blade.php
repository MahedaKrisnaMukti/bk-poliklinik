@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Tambah Data
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

                <form id="formSubmit" method="POST" action="/admin/obat" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-1">
                        <label class="form-label" for="name">
                            Nama
                        </label>

                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Masukan Nama Obat" autocomplete="off">
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="packaging">
                            Kemasan
                        </label>

                        <select class="form-control select2" name="packaging" id="packaging">
                            <option value="">
                                Pilih salah satu
                            </option>

                            <option value="Tablet">
                                Tablet
                            </option>

                            <option value="Capsule">
                                Capsule
                            </option>
                        </select>
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
                                onkeypress="return inputNumber()" onkeyup="formatNumber(this)" placeholder="Masukan Harga"
                                autocomplete="off">
                        </div>
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-gradient-primary w-100" id="btnSubmit">
                        <i class="bi bi-check2-circle"></i>
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        $('#formSubmit').submit(function(e) {
            let status = validate();
            let form = this;
            e.preventDefault();

            if (status) {
                confirmSubmit(form);
            }
        });

        function validate() {
            const name = $('#name');
            const packaging = $('#packaging');
            const price = $('#price');

            if (name.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Nama Obat tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (packaging.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Kemasan Obat tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (price.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Harga Obat tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            return true;
        }
    </script>
@endsection
