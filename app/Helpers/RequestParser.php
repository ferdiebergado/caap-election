<?php 
namespace App\Helpers;

trait RequestParser
{
    /**
     * @param $search
     *
     * @return array
     */
    protected function getRequestLength($request)
    {
        $perPage = config('app.perpage');
        $length = (integer)$request->length;
        if ($length) {
            $perPage = $length;
        }
        return $perPage;
    }
}
