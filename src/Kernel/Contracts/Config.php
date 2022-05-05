<?php

namespace RrEarring\BaiduTongji\Kernel\Contracts;


use RrEarring\BaiduTongji\Kernel\Support\Collection;

/**
 * Class Config
 * @package RrEarring\BaiduTongji\Kernel\Contracts
 */
class Config extends Collection
{

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if ('url' !== $key) {
            if ('list_url' !== $key) {
                return parent::get($key, $default);
            }
            return parent::get('is_business', $default) ? parent::get('business_list_url', $default) : parent::get('personal_list_url', $default);
        }
        return parent::get('is_business', $default) ? parent::get('business_url', $default) : parent::get('personal_url', $default);
    }

}