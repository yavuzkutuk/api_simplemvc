<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */


use Symfony\Component\HttpClient\HttpClient;

class StockManager extends AbstractManager
{
    public const TABLE = 'stock';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function decrementStock(int $id)
    {
        $statement = $this->pdo->prepare("UPDATE ".SELF::TABLE." SET quantity=:quantity WHERE id=:id");
        $statement->bindValue(':quantity', $quantity, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function getAll()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://geo.api.gouv.fr/communes/67365');

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
         $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
         $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
         $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        return $content;
    }

    public function buy(int $id)
    {
        $client = HttpClient::create();
        $response = $client->request('PUT', 'http://mvc.jfvps.ovh/stock/buy/'.$id);
    }
}
