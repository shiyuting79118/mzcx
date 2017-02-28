<?php

namespace PFinal\Http;

/**
 * Http Response
 * @author 邹义良
 */
class Response
{
    public $transferInfo;
    public $header;
    public $body;

    public function __construct(array $data)
    {
        foreach ($data as $k => $v) {
            $this->$k = $v;
        }
    }

    /**
     * http响应状态码
     * @return int
     */
    public function getStatusCode()
    {
        return isset($this->transferInfo['http_code']) ? $this->transferInfo['http_code'] : 0;
    }

    /**
     * http响应body
     * @return string
     */
    public function getBody()
    {
        return (string)$this->body;
    }

    /**
     * http响应头部信息
     * @return string
     */
    public function getHeaderRaw()
    {
        return (string)$this->header;
    }

    /**
     * 传输状态信息
     * @return array
     */
    public function getTransferInfo()
    {
        return (array)$this->transferInfo;
    }
}