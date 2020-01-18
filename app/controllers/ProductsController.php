<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Pagination\PhalconFrameworkPaginatorAdapter;
use App\Transformers\ProductTransformer;
use App\Transformers\Serializer;
use League\Fractal\Manager;
use App\Models\Products;

class ProductsController extends ControllerBase
{

    public function indexAction()
    {
        $page   = $this->request->getQuery('page', 'int', 1);
        $code   = $this->request->getQuery('code', 'int', null);
        $limit  = $this->request->getQuery('limit', 'int', 10);
        $userId = $this->request->getHeader('userId');

        $data = !$code ? Products::find() : Products::find([
            'conditions' => "code LIKE '%$code%'"
        ]);

        $paginator = new PaginatorModel([
            "data"  => $data,
            "limit" => $limit,
            "page"  => $page,
        ]);

        $products = $paginator->getPaginate();

        $resource = new Collection($products->items, new ProductTransformer($userId));
        $resource->setPaginator(new PhalconFrameworkPaginatorAdapter($products));
        $fractal = new Manager();
        $resource = $fractal->createData($resource)->toArray();

        return $this->sendJson($resource, 200);
    }

    public function showAction()
    {
        $userId = $this->request->getHeader('userId');

        $id = $this->dispatcher->getParam('id');
        $product = Products::findFirst([
            'conditions' => "id = $id",
        ]);

        if(!$product)
            return $this->notFoundResponse();

        $product = new Item($product, new ProductTransformer($userId));
        $fractal = new Manager();
        $fractal->setSerializer(new Serializer());
        $fractal->parseIncludes('rates');
        $product = $fractal->createData($product)->toArray();

        return $this->sendJson($product, 200);
    }

    public function updateAction()
    {
        $userId    = $this->request->getHeader('userId');
        $productId = $this->dispatcher->getParam('id');

        $product = Products::findFirst([
            'conditions' => "id = $productId AND user_id = $userId",
            'for_update' => true,
        ]);

        if(!$product)
            return $this->notFoundResponse();
        
        $updated = $product->update(
            $this->request->getPut(), 
            array('code', 'name', 'description', 'price')
        );

        if(!$updated)
            return $this->notFoundResponse();

        return $this->successfulUdatingResponse();
    }

}

