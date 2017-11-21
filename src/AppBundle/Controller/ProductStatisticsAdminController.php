<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Ob\HighchartsBundle\Highcharts\Highchart;
use  Zend\Json\Expr;

class ProductStatisticsAdminController extends Controller
{
    public function listAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        //... use any methods or services to get statistics data
        // $statisticsData = array();
        
        
        // Chart 
         $series = array(
                array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
            );

            $ob = new Highchart();
            $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
            $ob->title->text('Chart Title');
            $ob->xAxis->title(array('text'  => "Horizontal axis title"));
            $ob->yAxis->title(array('text'  => "Vertical axis title"));
            $ob->series($series);
        
            
        // chart 1
            $ob1 = new Highchart();
            $ob1->chart->renderTo('piechart');
            $ob1->title->text('Browser market shares at a specific website in 2010');
            $ob1->plotOptions->pie(array(
                'allowPointSelect'  => true,
                'cursor'    => 'pointer',
                'dataLabels'    => array('enabled' => false),
                'showInLegend'  => true
            ));
            $data = array(
                array('Firefox', 45.0),
                array('IE', 26.8),
                array('Chrome', 12.8),
                array('Safari', 8.5),
                array('Opera', 6.2),
                array('Others', 0.7),
            );
            $ob1->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
            
            
        // Chart 2
            
            $series2 = array(
            array(
                'name'  => 'Rainfall',
                'type'  => 'column',
                'color' => '#4572A7',
                'yAxis' => 1,
                'data'  => array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4),
            ),
            array(
                'name'  => 'Temperature',
                'type'  => 'spline',
                'color' => '#AA4643',
                'data'  => array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6),
            ),
        );
        $yData = array(
            array(
                'labels' => array(
                    'formatter' => new Expr('function () { return this.value + " degrees C" }'),
                    'style'     => array('color' => '#AA4643')
                ),
                'title' => array(
                    'text'  => 'Temperature',
                    'style' => array('color' => '#AA4643')
                ),
                'opposite' => true,
            ),
            array(
                'labels' => array(
                    'formatter' => new Expr('function () { return this.value + " mm" }'),
                    'style'     => array('color' => '#4572A7')
                ),
                'gridLineWidth' => 0,
                'title' => array(
                    'text'  => 'Rainfall',
                    'style' => array('color' => '#4572A7')
                ),
            ),
        );
        $categories = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

        $ob2 = new Highchart();
        $ob2->chart->renderTo('container1'); // The #id of the div where to render the chart
        $ob2->chart->type('column');
        $ob2->title->text('Average Monthly Weather Data for Tokyo');
        $ob2->xAxis->categories($categories);
        $ob2->yAxis($yData);
        $ob2->legend->enabled(false);
        $formatter = new Expr('function () {
                         var unit = {
                             "Rainfall": "mm",
                             "Temperature": "degrees C"
                         }[this.series.name];
                         return this.x + ": <b>" + this.y + "</b> " + unit;
                     }');
        $ob2->tooltip->formatter($formatter);
        $ob2->series($series2);
            
            
            
            
            
            
            
            
            

                return $this->render('AppBundle:ProductStatistics:product_statistics.html.twig', array(
                    'chart'  => $ob,
                    'chart1'  => $ob1,
                    'chart2'  => $ob2,
                ));
    }
}