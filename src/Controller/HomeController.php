<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\StockManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $stockManager = new StockManager();
        $allStock = $stockManager->getAll();
        return $this->twig->render('Home/index.html.twig', ['allStock' => $allStock]);
    }


    public function buy(int $id)
    {

        $stockManager = new StockManager();
        $updStock = $stockManager->buy($id);
        header('Location: /home/index');
    }
}
