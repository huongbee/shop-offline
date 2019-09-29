<?php
class Cart
{
    public $items = [];  // all info product in cart
    public $totalQty = 0; // tong so luong sp da mua
    public $totalPrice = 0; // tong tien chua co khuyen mai
    public $promtPrice = 0; // tong tien co khuyen mai => tien thanh toan

    public function __construct($oldCart = null)
    {
        // kiem tra xem truoc do da mua sp nao hay chua
        // neu chua mua thi all  = 0 
        if ($oldCart != null) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->promtPrice = $oldCart->promtPrice;
        }
    }
    public function add($product, $qty = 1)
    {
        // kiem tra sp co khuyen mai
        // tien thanh toan se la don gia goc
        if ($product->promotion_price == 0) {
            $product->promotion_price = $product->price;
        }
        // init luu thong tin cua sp ma ban dang mua
        // truong hop truoc do chua mua sp do
        $giohang = [
            'qty' => 0,
            'price' => 0, // don gia cua nhieu so luong
            'promotionPrice' => 0,
            'item' => null
        ];
        if (!empty($this->items) and array_key_exists($product->id, $this->items)) {
            // lay thong tin sp da mua truoc do
            $giohang = $this->items[$product->id];
        }
        $giohang['qty'] =  $giohang['qty'] + $qty;
        $giohang['price'] = $product->price * $giohang['qty'];
        $giohang['promotionPrice'] = $product->promotion_price * $giohang['qty'];
        $giohang['item'] = $product;

        $this->items[$product->id] = $giohang;

        $this->totalQty = $this->totalQty + $qty;
        $this->totalPrice = $this->totalPrice + $qty * $giohang['item']->price;
        $this->promtPrice = $this->promtPrice + $qty * $giohang['item']->promotion_price;
    }

    public function update($item, $qty = 1)
    {
        if ($item->promotion_price == 0) {
            $item->promotion_price = $item->price;
        }
        $giohang = [
            'qty' => $qty,
            'price' => $item->price * $qty,
            'promotionPrice' => $item->promotion_price * $qty,
            'item' => $item
        ];
        $id = $item->id;
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $this->totalPrice -= $this->items[$id]['price'];
                $this->promtPrice -= $this->items[$id]['promotionPrice'];
                $this->totalQty -= $this->items[$id]['qty'];
            }
        }
        // $giohang['price'] = $item->price * $giohang['qty'];
        // $giohang['promotionPrice'] = $item->promotion_price * $giohang['qty'];
        $this->items[$id] = $giohang;
        $this->totalQty = $this->totalQty + $qty;
        $this->totalPrice = $this->totalPrice + $giohang['price'];
        $this->promtPrice = $this->promtPrice + $giohang['promotionPrice'];
    }

    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']->price;
        $this->items[$id]['promotionPrice'] -= $this->items[$id]['item']->promotion_price;
        $this->totalQty--;
        $this->totalPrice = ($this->totalPrice - $this->items[$id]['item']->price);
        $this->promtPrice = ($this->promtPrice - $this->items[$id]['item']->promotion_price);

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        $this->promtPrice -= $this->items[$id]['promotionPrice'];
        unset($this->items[$id]);
    }
}


/**
 * 
 * Cart Object
(
    [items] => Array
        (
            [1] => Array
                (
                    [qty] => 1
                    [price] => 34790000
                    [promotionPrice] => 32790000
                    [item] => stdClass Object
                        (
                            [id] => 1
                            [name] => iPhone X 256GB
                            [price] => 34790000
                            [promotion_price] => 32790000
                            [image] => iphone-x-256gb.png
                        )

                )

        )

    [totalQty] => 1
    [totalPrice] => 34790000
    [promtPrice] => 32790000
)


Cart Object
(
    [items] => Array
        (
            [7] => Array
                (
                    [qty] => 1
                    [price] => 19999000
                    [promotionPrice] => 19909000
                    [item] => stdClass Object
                        (
                            [id] => 7
                            [name] => iPhone 7 Plus 32GB
                            [price] => 19999000
                            [promotion_price] => 19909000
                            [image] => iphone-7-plus-32gb.png
                        )

                )

            [2] => Array
                (
                    [qty] => 1
                    [price] => 29990000
                    [promotionPrice] => 29900000
                    [item] => stdClass Object
                        (
                            [id] => 2
                            [name] => iPhone X 64GB
                            [price] => 29990000
                            [promotion_price] => 29900000
                            [image] => iphone-x-64gb.png
                        )

                )

        )

    [totalQty] => 2
    [totalPrice] => 49989000
    [promtPrice] => 49809000
)
Cart Object
(
    [items] => Array
        (
            [7] => Array
                (
                    [qty] => 1
                    [price] => 19999000
                    [promotionPrice] => 19909000
                    [item] => stdClass Object
                        (
                            [id] => 7
                            [name] => iPhone 7 Plus 32GB
                            [price] => 19999000
                            [promotion_price] => 19909000
                            [image] => iphone-7-plus-32gb.png
                        )

                )

            [2] => Array
                (
                    [qty] => 2
                    [price] => 59980000
                    [promotionPrice] => 59800000
                    [item] => stdClass Object
                        (
                            [id] => 2
                            [name] => iPhone X 64GB
                            [price] => 29990000
                            [promotion_price] => 29900000
                            [image] => iphone-x-64gb.png
                        )

                )

        )

    [totalQty] => 3
    [totalPrice] => 79979000
    [promtPrice] => 79709000
)

 */
