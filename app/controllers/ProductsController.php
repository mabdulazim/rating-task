<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Pagination\PhalconFrameworkPaginatorAdapter;
use App\Transformers\ProductTransformer;
use App\Transformers\Serializer;

use App\DTOs\ProductDTO;
use App\Services\ProductService;

class ProductsController extends ControllerBase
{
    private $productService;
    private $fractal;

    public function onConstruct() 
    {
        $this->productService = new ProductService();
        $this->fractal = new Manager();
        $this->fractal->setSerializer(new Serializer());
    }

    public function indexAction()
    {
        // REQUEST PARAMS
        $page   = $this->request->getQuery('page', 'int', 1);
        $limit  = $this->request->getQuery('limit', 'int', 10);
        $code   = $this->request->getQuery('code', 'int', null);
        $userId = $this->request->getHeader('userId');

        // GER PRODUCTS
        $products = $this->productService->getProducts($code);

        // HANDLE PAGINATION
        $paginator = new PaginatorModel([
            "data"  => $products,
            "limit" => $limit,
            "page"  => $page,
        ]);
        $products = $paginator->getPaginate();

        // HANDLE TRANSFORMER
        $resource = new Collection($products->items, new ProductTransformer($userId));
        $resource->setPaginator(new PhalconFrameworkPaginatorAdapter($products));
        $products = $this->fractal
        ->createData($resource)
        ->toArray();

        // RETURN RESPONSE
        $this->jsonResponse($products, 200);
    }

    public function showAction()
    {
        // REQUEST PARAMS
        $userId    = $this->request->getHeader('userId');
        $productId = $this->dispatcher->getParam('id');

        // GET PRODUCT BY ID
        $product = $this->productService->getProductById($productId);

        // TRANSFORMER PRODUCT OBJECT
        $product = new Item($product, new ProductTransformer($userId));
        $product = $this->fractal
        ->parseIncludes('rates')
        ->createData($product)
        ->toArray();

        // RETURN RESPONSE
        $this->jsonResponse($product, 200);
    }

    public function updateAction()
    {
        // CREATE DATA TRANSFER OBJECT
        $productDTO = new ProductDTO(
            $this->dispatcher->getParam('id'),
            $this->request->getHeader('userId'),
            $this->request->getPut('code'),
            $this->request->getPut('name'),
            $this->request->getPut('description'),
            $this->request->getPut('price')
        );

        // PASS DTO TO UPDATE PRODUCT SERVICE
        $this->productService->updateProduct($productDTO);

        // RETURN SUCCESSFULL RESPONSE
        $this->handleSuccessResponse("Updated successfully");
    }

}

