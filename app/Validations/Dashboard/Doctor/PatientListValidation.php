<?php

namespace App\Validations\Dashboard\Doctor;

use Illuminate\Support\Facades\Crypt;

use App\Functions\CartFunction;

use App\Models\PoliRegister;

class PatientListValidation
{
    /**
     * Functions instance.
     *
     * @var \App\Functions\CartFunction
     */
    protected $cartFunction;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(CartFunction $cartFunction)
    {
        $this->cartFunction = $cartFunction;
    }

    /**
     * Update validation.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function update($request)
    {
        $id = Crypt::decrypt($request->id);

        $poliRegister = PoliRegister::firstWhere('id', $id);

        $cartResult = $this->cartFunction->getContent($poliRegister->patient_id);
        $cart = $cartResult->cart;

        if ($cart->count() == 0) {
            $status = false;
            $statusAlert = 'fail';
            $message = 'Obat belum diinputkan !';

            $result = (object) [
                'status' => $status,
                'statusAlert' => $statusAlert,
                'message' => $message,
            ];

            return $result;
        }

        // * Jika validasi benar semua
        $status = true;
        $message = 'Validasi berhasil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
