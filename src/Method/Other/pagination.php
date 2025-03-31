<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 *
 * @param int $curPage
 * @param int $limitOnePage
 * @param int $countRecords
 * @return array{
 * pageCount:int,
 * recordCount:int,
 * recordPerPage:int,
 * curPage:int,
 * offset:int,
 * next:?int,
 * prev:?int,
 * isLast:bool,
 * isFirst:bool
 * }
 */
function pagination(int $curPage, int $limitOnePage, int $countRecords)
{
    $obj = new class
    {
        /**
         * @return array
         */
        function getAll($curPage, $limitOnePage, $countRecords)
        {
            $limitOnePage = \abs($limitOnePage);
            $countRecords = \abs($countRecords);
            $countPages   = $this->getCountPages($limitOnePage, $countRecords);
            $curPage      = $this->getValidCurPage($curPage, $countPages);

            return [
                'pageCount'     => $countPages,
                'recordCount'   => $countRecords,
                'recordPerPage' => $limitOnePage,
                'curPage'       => $curPage,
                'offset'        => $this->offset($curPage, $countPages, $limitOnePage),
                'next'          => $this->next($curPage, $countPages),
                'prev'          => $this->prev($curPage, $countPages),
                'isLast'        => $this->isLast($curPage, $countPages),
                'isFirst'       => $this->isFirst($curPage),
            ];
        }

        /**
         * @return int|null
         */
        function next($curPage, $countPages)
        {
            $curPage    = $this->getValidCurPage($curPage, $countPages);
            $countPages = $this->prepareCountPages($countPages);
            if ($curPage === $countPages || $countPages === 1) {
                return null;
            }
            return $curPage + 1;
        }

        /**
         * @return int|null
         */
        function prev($curPage, $countPages)
        {
            $curPage = $this->getValidCurPage($curPage, $countPages);
            if ($curPage === 1) {
                return null;
            }
            return $curPage - 1;
        }

        /**
         * Получить общее количество страниц
         * @return int<1,max>
         */
        function getCountPages($limitOnePage, $countRecords)
        {
            $limitOnePage = \abs($limitOnePage);
            if ($limitOnePage === 0) {
                return 1;
            }
            $countRecords = \abs($countRecords);
            if ($countRecords === 0) {
                return 1;
            }
            $c = \intval(
                \ceil($countRecords / $limitOnePage)
            );
            return $c <= 0 ? 1 : $c;
        }

        /**
         * расчитываем offset для sql запроса
         * @return int<0,max>
         */
        function offset($curPage,  $countPages,  $limitOnePage)
        {
            $curPage      = $this->getValidCurPage($curPage, $countPages);
            $limitOnePage = \abs($limitOnePage);
            $offset       = ($curPage * $limitOnePage) - $limitOnePage;
            return $offset < 0 ? 0 : $offset;
        }

        /**
         * @return int<1,max>
         */
        function getValidCurPage($curPage,  $countPages)
        {
            $curPage   = $this->prepareCurPage($curPage);
            if ($curPage === 1) {
                return 1;
            }
            $countPages = $this->prepareCountPages($countPages);
            return $curPage > $countPages ? $countPages : $curPage;
        }

        /**
         * @return bool
         */
        function isLast($curPage, $countPages)
        {
            $countPages = $this->prepareCountPages($countPages);
            $curPage    = $this->prepareCurPage($curPage);
            return $curPage >= $countPages;
        }

        /**
         * @return bool
         */
        function isFirst($curPage)
        {
            return $this->prepareCurPage($curPage) === 1;
        }

        /**
         * @protected
         * @return int<1,max>
         */
        function prepareCurPage($curPage)
        {
            return $curPage <= 0 ? 1 : $curPage;
        }

        /**
         * @protected
         * @return int<1,max>
         */
        function prepareCountPages($countPages)
        {
            $countPages = \abs($countPages);
            return $countPages === 0 ? 1 : $countPages;
        }
    };

    return $obj->getAll($curPage, $limitOnePage, $countRecords);
}
