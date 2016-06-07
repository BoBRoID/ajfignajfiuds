<?php

namespace frontend\modules\admin\controllers;

use common\models\Category;
use common\models\Good;
use frontend\modules\admin\models\GoodForm;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionCategories(){
        return $this->render('categories', [
            'dataProvider'  =>  new ActiveDataProvider([
                'query'     =>  Category::find()
            ])
        ]);
    }
    
    public function actionCategory($id){
        $category = Category::findOne(['id' => $id]);

        if(!$category){
            throw new NotFoundHttpException("Категория с идентификатором {$id} не найдена!");
        }

        return $this->render('category', [
            'category'  =>  $category
        ]);
    }
    
    public function actionGoods(){
        return $this->render('goods', [
            'dataProvider'  =>  new ActiveDataProvider([
                'query'     =>  Good::find()
            ])
        ]);
    }

    public function actionBalanceChange(){
        if(!\Yii::$app->request->isAjax){
            throw new BadRequestHttpException("Данный запрос возможен только через ajax!");
        }

        $good = Good::findOne(['id' => \Yii::$app->request->get("goodID")]);

        if(!$good){
            throw new NotFoundHttpException("Товар не найден!");
        }

        $store = $good->getBalance(\Yii::$app->request->post("editableKey"));

        $store->count = \Yii::$app->request->post("storeCount");

        $store->save(false);

        return $store->count;
    }

    public function actionGood($id){
        $good = Good::findOne(['id' => $id]);

        if(!$good){
            throw new NotFoundHttpException("Товар с идентификатором {$id} не найден!");
        }

        if(\Yii::$app->request->get("act") == 'edit'){
            $goodForm = new GoodForm();

            $goodForm->loadGood($good);
            if(\Yii::$app->request->post("GoodForm")){
                $goodForm->load(\Yii::$app->request->post());

                $goodForm->save();
            }

            return $this->render('goodForm', [
                'good'  =>  $goodForm
            ]);
        }

        return $this->render('good', [
            'good'  =>  $good
        ]);
    }
}
