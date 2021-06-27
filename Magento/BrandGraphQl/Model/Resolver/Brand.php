<?php
/**
 * Copyright © 2021 MDC_NCN, LLC. All rights reserved.
 */
declare(strict_types=1);

namespace Magento\BrandGraphQl\Model\Resolver;

use Magento\BrandGraphQl\Model\Resolver\DataProvider\Brand as BrandDataProvider;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Brand page field resolver, used for GraphQL request processing
 * Resolver fetches the data and formats it according to the GraphQL schema.
 */
class Brand implements ResolverInterface
{
    /**
     * @var BrandDataProvider
     */
    private BrandDataProvider $brandDataProvider;

    /**
     *
     * @param BrandDataProvider $brandDataProvider
     */
    public function __construct(
        BrandDataProvider $brandDataProvider
    ) {
        $this->brandDataProvider = $brandDataProvider;
    }

    /**
     * Fetches the brand data from persistence models and format it according to the GraphQL schema.
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        if (!isset($args['code'])) {
            throw new GraphQlInputException(__('"Brand code should be specified'));
        }

        $brandData = [];

        try {
            if (isset($args['code'])) {
                $brandData = $this->brandDataProvider->getBrandDataByCode((string)$args['code']);
            }
        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }

        return $brandData;
    }
}
