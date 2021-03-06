<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Exporter
 *
 * @author alpha
 */
namespace AppBundle\Export;
 
use Exporter\Source\SourceIteratorInterface;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Export\Exporter as BaseExporter;
 
class Exporter extends BaseExporter
{
    protected $knpSnappyPdf;
    protected $templateEngine;
 
    public function getResponse($format, $filename, SourceIteratorInterface $source)
    {
        if ('pdf' != $format) {
            return parent::getResponse($format, $filename, $source);
        }
 
        $html = $this->templateEngine->render('AppBundle:Export:pdf.html.twig', array(
            'source' => $source
        ));
        $content = $this->knpSnappyPdf->getOutputFromHtml($html);
 
        return new Response($content, 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => sprintf('attachment; filename=%s', $filename)
        ));
    }
 
    public function setKnpSnappyPdf($service)
    {
        $this->knpSnappyPdf = $service;
    }
 
    public function setTemplateEngine($service)
    {
        $this->templateEngine = $service;
    }
}