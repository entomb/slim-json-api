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

    public function render($status=200, $data = NULL) {
        $app = \Slim\Slim::getInstance();

        $status = intval($status);

        $response = $this->all();

        //append error bool
        if (!$this->has('error')) {
            $response['error'] = false;
        }

        //append status code
        $response['status'] = $status;

		//add flash messages
		if(isset($this->data->flash) && is_object($this->data->flash)){
		    $flash = $this->data->flash->getMessages();
            if (count($flash)) {
                $response['flash'] = $flash;   
            } else {
                unset($response['flash']);
            }
		}
		
        $app->response()->status($status);
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->body(json_encode($response));

        $app->stop();
    }

}
