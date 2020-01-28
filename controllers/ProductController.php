<?php

namespace app\controllers;

use app\models\Products;

class ProductController extends Controller
{

    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $catalog = Products::getAll();
        echo $this->render('catalog', ['catalog' => $catalog]);
    }

    //Пока что не востребовано
    /*public function actionApiCatalog()
    {
        $catalog = Products::getAll();
        echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
        die();
    }*/

    public function actionCard()
    {
        $id = (int)$_GET['id'];
        $product = new Products($id);
        echo $this->render('card', ['product' => $product]);
    }



}