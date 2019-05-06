<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\OrderItem;

use App\Repositories\RepositoryAbstract;
use Validator;
use DB;
use App\Models\OrderItem;
use App\Repositories\ProductItem\ProductItemRepositoryInterface;

class OrderItemRepository extends RepositoryAbstract implements OrderItemRepositoryInterface
{
    protected $productItemRepository;
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(OrderItem $orderItem, ProductItemRepositoryInterface $productItemRepository)
    {
        parent::__construct();
        $this->model = $orderItem;
        $this->table = 'order_item';
        $this->productItemRepository = $productItemRepository;
    }

    /**
     * Get OrderItems by province.
     *
     * @param $filter
     * @return array object
     */

    public function addItem($items, $orderId)
    {
        $orderItems = [];
        foreach ($items as $key => $item) {
            $orderItems[] = [
                'order_id' => $orderId,
                'product_item_id' => $items[$key]['id'],
                'sku' => $items[$key]['sku'],
                'name' => $items[$key]['name'],
                'iprice' => getAmount($items[$key]['iprice']),
                'price' => getAmount($items[$key]['price']),
                'image' => $items[$key]['image'],
                'quantity' => $items[$key]['quantity']
            ];
        }
        return $this->model->insert($orderItems);
    }
}