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

        $status = intval($status);

        //append error bool
        if (!$this->has('error')) {
            $this->set('error', false);
        }

        //append status code
        $this->set('status', $status);

        $app->response()->status($status);
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->body(json_encode($this->all()));

        $app->stop();
    }

}
