<?php
/**
 * jsonAPI - Slim extension to implement fast JSON API's
 *
 * @package Slim
 * @subpackage View
 * @author Jonathan Tavares <the.entomb@gmail.com>
 * @license GNU General Public License, version 3
 * @filesource
 *
 *
*/


/**
 * JsonApiView - view wrapper for json responses (with error code).
 *
 * @package Slim
 * @subpackage View
 * @author Jonathan Tavares <the.entomb@gmail.com>
 * @license GNU General Public License, version 3
 * @filesource
 */
class JsonApiView extends \Slim\View {

    public function render($status=200) {

        $app = \Slim\Slim::getInstance();

        //append error bool
        if(!isset($this->data['error'])){
            $this->appendData(array('error'=>false));
        }

        $this->status = (int)$status;

        //append status code
        if(isset($this->status)){
            $this->appendData(array('status'=>$this->status));
        }

        //remove useless flash data
        unset($this->data['flash']);

        $app->response()->status($this->status);
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->body(json_encode($this->data));

        $app->stop();
    }

}