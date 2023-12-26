<?php

namespace App\Functions;

use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartFunction
{
    /**
     * Check item function.
     *
     * @param  $itemId
     * @return ArrayObject
     */
    public function checkItem($itemId)
    {
        $userId = auth()->user()->id;
        $item = Cart::session($userId)->get($itemId);

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
     * @return ArrayObject
     */
    public function getContent()
    {
        $userId = auth()->user()->id;
        $cart = Cart::session($userId)->getContent();

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
     * @param  $item
     * @return ArrayObject
     */
    public function add($item)
    {
        $userId = auth()->user()->id;
        Cart::session($userId)->add($item);

        $item = (object) $item;
        $name = $item->name;

        $status = true;
        $message = $name . ' berhasil ditambahkan ke keranjang !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Update function.
     *
     * @param  $itemId
     * @param  $item
     * @return ArrayObject
     */
    public function update($itemId, $item)
    {
        $result = $this->checkItem($itemId);

        $userId = auth()->user()->id;
        Cart::session($userId)->update($itemId, $item);

        $item = $result->item;
        $name = $item->name;

        $status = true;
        $message = $name . ' berhasil diubah di keranjang !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Remove function.
     *
     * @param  $itemId
     * @return ArrayObject
     */
    public function remove($itemId)
    {
        $result = $this->checkItem($itemId);

        $userId = auth()->user()->id;
        Cart::session($userId)->remove($itemId);

        $item = $result->item;
        $name = $item->name;

        $status = true;
        $message = $name . ' berhasil dihapus dari keranjang !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Clear function.
     *
     * @param  $itemId
     * @return ArrayObject
     */
    public function clear()
    {
        $userId = auth()->user()->id;
        Cart::session($userId)->clear();

        $status = true;
        $message = 'Keranjan berhasil dikosongkan !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
