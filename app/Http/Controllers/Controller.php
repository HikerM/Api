<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $verifyObj; //验证类
    public $verifyData; // 验证成功后的数据

    public $helperObj = array(); // helper类

    public function response(array $data = [] , array $list = [] , string $code = '200')
    {
        $data = [
            'status' => true,
            'error_msg' => 'OK',
            'error_code' => '',
            'data' => empty($data) ? null : $data,
            'list' => $list,
         ];
         !config('app.debug') ? false : $data['debug'] = array(
            'run_time' => get_run_time() . ' ms'
        );

        return response()->json($data, $code, array(), JSON_UNESCAPED_UNICODE);
    }
    /**
     * 应答列表数据api
     * @param array $list
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseList($list = array())
    {
        return $this->response(array(), $list);
    }

    /**
     * 应答错误api
     * @param $error_msg $string 错误信息
     * @param string $error_id 错误id
     * @param int $status_code http状态码
     * @throws ApiException
     */
    public function responseError($error_msg, $error_id = 'ERROR', $status_code = 400)
    {
        response_error($error_msg, $error_id, $status_code);
    }

    /**
     * 验证
     * @param \Illuminate\Http\Request $request
     * @throws ApiException
     */
    public function verify(array $rule, $data = 'GET')
    {
        if (empty($this->verifyObj)) {
            $this->verifyObj = new \App\Common\Verify();
        }

        $result = $this->verifyObj->check($rule, $data);
        $this->verifyData = $this->verifyObj->getData();

        return $result;
    }

    /**
     * 验证ID
     * @param \Illuminate\Http\Request $request
     * @throws ApiException
     */
    public function verifyId($id)
    {
        if (empty($verifyObj)) {
            $this->verifyObj = new \App\Common\Verify();
        }

        $result = $this->verifyObj->egnum($id);
        if (!$result) {
            throw new \ApiException('id验证错误', 'id_ERROR', 422);
        }

        return true;
    }

    /**
     * 设置保存的数据
     * @param Object $model
     * @param array $data
     * @return object
     */
    public function setSaveData($model, $data)
    {
        foreach ($data as $key => $v) {
            $model->$key = $v;
        }

        return $model;
    }

    /**
     * 加载helper
     * @param $class_name
     * @return bool
     */
    public function loadHelper($class_name)
    {
        if (isset($this->helperObj[$class_name])) {
            return true;
        }

        load_helper($class_name);
        $this->helperObj[$class_name] = 1;

        return true;
    }
}
