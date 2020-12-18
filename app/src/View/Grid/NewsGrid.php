<?php

declare(strict_types=1);

namespace App\View\Grid;

use Spiral\DataGrid\GridSchema;
use Spiral\DataGrid\Specification\Filter\Equals;
use Spiral\DataGrid\Specification\Filter\Like;
use Spiral\DataGrid\Specification\Pagination\PagePaginator;
use Spiral\DataGrid\Specification\Sorter\Sorter;
use Spiral\DataGrid\Specification\Value\IntValue;
use Spiral\DataGrid\Specification\Value\StringValue;
use Spiral\Prototype\Annotation\Prototyped;

/**
 * @Prototyped(property="newsGrid")
 */
class NewsGrid extends GridSchema
{
    public function __construct()
    {
        $this->addFilter('title', new Like('title', new StringValue()));
        $this->addFilter('id', new Equals('title', new IntValue()));

        $this->addSorter('id', new Sorter('id'));

        // default limit, available limits
        $this->setPaginator(new PagePaginator(10, [10, 20, 50]));
    }
}
