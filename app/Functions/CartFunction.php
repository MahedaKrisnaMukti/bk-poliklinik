<?php

namespace App\Functions;

use Darryldecode\Cart\Facades\CartFacade as Cart;

use App\Models\Patient;

class CartFunction
{
    /**
     * Check item function.
     *
     * @param  $patientId
     * @param  $itemId
     * @return ArrayObject
     */
    public function checkItem($patientId, $itemId)
    {
        $userId = auth()->user()->id;

        $patient = Patient::firstWhere('id', $patientId);

        $sessionId = 'doctor' . $userId . 'patient' . $patient->user_id;
        $item = Cart::session($sessionId)->get($itemId);

        if ($item) {
            $status = true;
            $message = 'Data tersedia !';
        } else {
            $status = false;
            $message = 'Data tidak tersedia !';
        }


        $result = (object) [
            'status' => $status,
            'message' => $message,
            'item' => $item,
        ];

        return $result;
    }

    /**
     * Get content function.
     *
     * @param  $patientId
     * @return ArrayObject
     */
    public function getContent($patientId)
    {
        $userId = auth()->user()->id;

        $patient = Patient::firstWhere('id', $patientId);

        $sessionId = 'doctor' . $userId . 'patient' . $patient->user_id;
        $cart = Cart::session($sessionId)->getContent();

        $status = true;
        $message = 'Data berhasil dibuat';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'cart' => $cart,
        ];

        return $result;
    }

    /**
     * Add function.
     *
     * @param  $patientId
     * @param  $item
     * @return ArrayObject
     */
    public function add($patientId, $item)
    {
        $userId = auth()->user()->id;

        $patient = Patient::firstWhere('id', $patientId);

        $sessionId = 'doctor' . $userId . 'patient' . $patient->user_id;
        Cart::session($sessionId)->add($item);

        $item = (object) $item;
        $name = $item->name;

        $status = true;
        $message = $name . ' berhasil ditambahkan !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Update function.
     *
     * @param  $patientId
     * @param  $itemId
     * @param  $item
     * @return ArrayObject
     */
    public function update($patientId, $itemId, $item)
    {
        $result = $this->checkItem($patientId, $itemId);

        $userId = auth()->user()->id;

        $patient = Patient::firstWhere('id', $patientId);

        $sessionId = 'doctor' . $userId . 'patient' . $patient->user_id;
        Cart::session($sessionId)->update($itemId, $item);

        $item = $result->item;
        $name = $item->name;

        $status = true;
        $message = 'Jumlah ' . $name . ' berhasil diubah !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Remove function.
     *
     * @param  $patientId
     * @param  $itemId
     * @return ArrayObject
     */
    public function remove($patientId, $itemId)
    {
        $result = $this->checkItem($patientId, $itemId);

        $userId = auth()->user()->id;

        $patient = Patient::firstWhere('id', $patientId);

        $sessionId = 'doctor' . $userId . 'patient' . $patient->user_id;
        Cart::session($sessionId)->remove($itemId);

        $item = $result->item;
        $name = $item->name;

        $status = true;
        $message = 'Jumlah ' . $name . ' berhasil diubah !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Clear function.
     *
     * @param  $patientId
     * @return ArrayObject
     */
    public function clear($patientId)
    {
        $userId = auth()->user()->id;

        $patient = Patient::firstWhere('id', $patientId);

        $sessionId = 'doctor' . $userId . 'patient' . $patient->user_id;
        Cart::session($sessionId)->clear();

        $status = true;
        $message = 'Keranjang berhasil dikosongkan !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
