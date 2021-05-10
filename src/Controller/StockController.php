<?php


namespace App\Controller;


use App\Model\StockManager;

class StockController extends AbstractAPIController
{

    public function all()
    {
        $stockManager = new StockManager();
        return json_encode($stockManager->selectAll());
    }

    public function buy(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $stockManager = new StockManager();
            $stockManager->decrementStock($id);
        }
    }


}