<?php

class SiteController extends Controller
{


    public function actionEvents()
    {
        $this->layout = "contentlist";
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->compare('isBlog', 1);
        $criteria->compare('catID', 6);

        $item_count = Content::model()->count($criteria);

        $pages = new CPagination($item_count);
        $pages->setPageSize(Yii::app()->params['blogPerPage']);
        $pages->applyLimit($criteria);


        $model = Content::model()->findAll($criteria);


        $this->render('index', array(
            'html' => $this->generateBlogposts($model),
            'item_count' => $item_count,
            'page_size' => Yii::app()->params['blogPerPage'],
            'items_count' => $item_count,
            'pages' => $pages,
        ));
    }


    public function actionSparkle()
    {
        $this->layout = "contentlist";
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->compare('isBlog', 1);
        $criteria->compare('catID', 4);
        $item_count = Content::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->setPageSize(Yii::app()->params['blogPerPage']);
        $pages->applyLimit($criteria);
        $model = Content::model()->findAll($criteria);
        $this->render('index', array(
            'html' => $this->generateBlogposts($model),
            'item_count' => $item_count,
            'page_size' => Yii::app()->params['blogPerPage'],
            'items_count' => $item_count,
            'pages' => $pages,
        ));
    }


    public function actionCharity()
    {
        $this->layout = "contentlist";
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->compare('isBlog', 1);
        $criteria->compare('catID', 7);
        $item_count = Content::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->setPageSize(Yii::app()->params['blogPerPage']);
        $pages->applyLimit($criteria);
        $model = Content::model()->findAll($criteria);
        $this->render('index', array(
            'html' => $this->generateBlogposts($model),
            'item_count' => $item_count,
            'page_size' => Yii::app()->params['blogPerPage'],
            'items_count' => $item_count,
            'pages' => $pages,
        ));
    }


    public function actionInterviews()
    {
        $this->layout = "contentlist";
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->compare('isBlog', 1);
        $criteria->compare('catID', 3);
        $item_count = Content::model()->count($criteria);
        $pages = new CPagination($item_count);
        $pages->setPageSize(Yii::app()->params['blogPerPage']);
        $pages->applyLimit($criteria);
        $model = Content::model()->findAll($criteria);


        $this->render('index', array(
            'html' => $this->generateBlogposts($model),
            'item_count' => $item_count,
            'page_size' => Yii::app()->params['blogPerPage'],
            'items_count' => $item_count,
            'pages' => $pages,
        ));
    }

    public function actionIndex()
    {

        $_GET['language'] = Yii::app()->language;
        $this->layout = "contentlist";
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->compare('isBlog', 1);

        $item_count = Content::model()->count($criteria);

        $pages = new CPagination($item_count);
        $pages->setPageSize(Yii::app()->params['blogPerPage']);
        $pages->applyLimit($criteria);


        $model = Content::model()->findAll($criteria);


        $this->render('index', array(
            'html' => $this->generateBlogposts($model),
            'item_count' => $item_count,
            'page_size' => Yii::app()->params['blogPerPage'],
            'items_count' => $item_count,
            'pages' => $pages,
        ));
    }


    protected function generateBlogposts($model)
    {
        $html = "";
        $lang = Yii::app()->language;
        if (count($model) > 0)
            foreach ($model as $blogpost) {
                $criteria = new CDbCriteria();
                $criteria->compare("blogID", $blogpost->id);
                $criteria->compare("lang", $lang);
                $slug = Slug::model()->find($criteria);
		if($slug){
                $timestamp = strtotime($slug->createdAt);

                $html .= "<div class='context'>";
                $html .= "<div class='con-left'>
        <h2><a href='/$slug->slug/" . strtotime($slug->createdAt) . "'>" . $blogpost->{'title_' . $lang} . "</a></h2>
    </div>
        <div class='clear'></div>
    <div class='con-data-cat'>
            <span class='pull-left'>
                <i class='fa fa-calendar'></i> " . date('d.m.Y', $timestamp) . "
            </span>
             <span class='pull-right'>
                <i class='fa fa-bookmark'></i> " . Yii::t('common', 'category') . ": <a class='category-link' href='/$lang/" . $blogpost->cat->token . "'>" . $blogpost->cat->{'title_' . $lang} . "</a>
             </span>
    </div>
    <div class='clear'></div>
    <div>
    <div class='con-img'><img src='/uploads/images/resize.php?src=$blogpost->imgUrl&h=140&w=200&zc=2&a=t' alt=''/></div>
    <div class='con-body'>" .
                    Typography::truncate(strip_tags($blogpost->{"content_" . $lang}), 500) . "
            </div>
            <div class='clear'></div>
        </div>
        <div>
        <div class='pull-left'>
         </div>

        <div class='con-fright'><a href='/$slug->slug/" . strtotime($slug->createdAt) . "'><i class='fa fa-book'></i> " . Yii::t("common", "readmore") . "</a></div>
        </div>
        <div class='clear'></div>
   </div>";
	}
	else continue;

            }
        return $html;
    }


    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->redirect("/");
        }
    }


    public function actionContact()
    {
        $model = new Request();
        if (isset($_POST['Request'])) {
            $model->attributes = $_POST['Request'];
            if ($model->save()) {
                Yii::app()->user->setFlash('contact', Yii::t("common", "sent"));
                $this->refresh();
            }
        }
        $this->layout = "column1";
        $this->render('contact', array('model' => $model));
    }

    public function actionThanks()
    {
        $this->redirect(Navigation::findUrlByID(array(
            "id" => 2,
            "lang" => Yii::app()->language
        )));
    }

    public function actionAbout()
    {
        $this->redirect(Navigation::findUrlByID(array(
            "id" => 1,
            "lang" => Yii::app()->language
        )));
    }

    public function actionPhotogallery()
    {
        $this->redirect("/" . Yii::app()->language . "/photogallery/index");
    }

    public function actionVideogallery()
    {
        $this->redirect("/" . Yii::app()->language . "/videogallery/index");
    }

}