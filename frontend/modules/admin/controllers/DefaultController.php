<?php

namespace frontend\modules\admin\controllers;

use common\models\Category;
use common\models\Good;
use frontend\modules\admin\models\CategoryForm;
use frontend\modules\admin\models\GoodForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
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
        return $this->redirect('/admin/goods');

        return $this->render('index');
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    return $this->goHome();
                },
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionCategories(){
        return $this->render('categories', [
            'dataProvider'  =>  new ActiveDataProvider([
                'query'     =>  Category::find()
            ])
        ]);
    }
    
    public function actionCategory($id = ''){
        $category = Category::findOne(['id' => $id]);

        if(!$category && \Yii::$app->request->get("act") != 'add'){
            throw new NotFoundHttpException("Категория с идентификатором {$id} не найдена!");
        }

        if(\Yii::$app->request->get("act") == 'edit' || \Yii::$app->request->get("act") == 'add'){
            $categoryForm = new CategoryForm();

            if($category){
                $categoryForm->loadCategory($category);
            }

            if(\Yii::$app->request->post("CategoryForm")){
                $categoryForm->load(\Yii::$app->request->post());

                if($categoryForm->save() && \Yii::$app->request->get("act") == 'add'){
                    return $this->redirect('/admin/category/'.$categoryForm->category->id);
                }
            }

            return $this->render('categoryForm', [
                'category'  =>  $categoryForm
            ]);
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

    public function actionGood($id = ''){
        $good = Good::findOne(['id' => $id]);

        if(!$good && \Yii::$app->request->get("act") != 'add'){
            throw new NotFoundHttpException("Товар с идентификатором {$id} не найден!");
        }

        if(\Yii::$app->request->get("act") == 'edit' || \Yii::$app->request->get("act") == 'add'){
            $goodForm = new GoodForm();

            if($good){
                $goodForm->loadGood($good);
            }

            if(\Yii::$app->request->post("GoodForm")){
                $goodForm->load(\Yii::$app->request->post());

                if($goodForm->save() && \Yii::$app->request->get("act") == 'add'){
                    return $this->redirect('/admin/good/'.$goodForm->good->id);
                }
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
