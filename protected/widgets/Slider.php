<?php

class Slider extends CWidget
{

    public function run()
    {
        $html = $this->generateSlider();
        $this->render('Slider', array('html' => $html));
    }


    public function generateSlider()
    {
        $html = "";
        $criteria = new CDbCriteria();
        $criteria->order = "sort ASC";
        $currentLang = Yii::app()->language;
        $results = Slideshow::model()->findAll($criteria);
        if (count($results) > 0) {
            $html = "<div id='carousel' class='carousel slide' data-ride='carousel'>
            <ol class='carousel-indicators'>";

            for ($counter = 0; $counter < count($results); $counter++) {
                $class = ($counter == 0) ? "active" : "";
                $html .= "<li data-target='#carousel' data-slide-to='$counter' class='$class'></li>";
            }
            $html .= "</ol>
            <div class='carousel-inner'>";
            $counter = 0;
            foreach ($results as $result) {
                $class = ($counter == 0) ? "active" : "";
                $html .= "
                    <div data-href='" . $result->{"url_" . $currentLang} . "' class='item mpslider-item $class'>
                        <img src='/uploads/images/resize.php?src=$result->imgUrl&w=1000&zc=2&a=t'>
                        <div class='slider-con'>
                            <div class='sli-con'>
                                <h1>" . $result->{"title_" . $currentLang} . "</h1>

                                <p>" . $result->{"text_" . $currentLang} . "</p>
                            </div>
                        </div>
                    </div>";


                $counter++;


            }
            $html .= "</div>
                <a class='carousel-control left' href='#carousel' data-slide='prev'></a>
                <a class='carousel-control right' href='#carousel' data-slide='next'></a>
            </div>";

        }
        return $html;
    }

}

?>
