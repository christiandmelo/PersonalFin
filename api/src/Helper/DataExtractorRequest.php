<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;

class DataExtractorRequest
{
    private function getDataFromRequest(Request $request)
    {
        $queryString = $request->query->all();
        $orderingData = array_key_exists('sort', $queryString)
            ? $queryString['sort']
            : null;
        unset($queryString['sort']);
        $currentPage = array_key_exists('page', $queryString)
            ? $queryString['page']
            : 1;
        unset($queryString['page']);
        $itensPerPage = array_key_exists('itensPerPage', $queryString)
            ? $queryString['itensPerPage']
            : 5;
        unset($queryString['itensPerPage']);

        return [$queryString, $orderingData, $currentPage, $itensPerPage];
    }

    public function getOrderingData(Request $request)
    {
        [, $ordering] = $this->getDataFromRequest($request);
        return $ordering;
    }

    public function getDataFilter(Request $request)
    {
        [$filter, ] = $this->getDataFromRequest($request);
        return $filter;
    }

    public function getPaginationData(Request $request)
    {
        [, , $currentPage, $itensPerPage] = $this->getDataFromRequest($request);
        return [$currentPage, $itensPerPage];
    }
}
