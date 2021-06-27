<?php
/**
 * Copyright © 2021 MDC_NCN, LLC. All rights reserved.
 */
declare(strict_types=1);

namespace Magento\BrandGraphQl\Model\Resolver\DataProvider;

use Magento\Brand\Api\Data\BrandInterface;
use Magento\Brand\Model\BrandFactory;
use Magento\Brand\Model\ResourceModel\Brand as BrandResourceModel;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Brand page data provider
 */
class Brand
{
    /**
     * @var BrandFactory
     */
    private BrandFactory $brandFactory;

    /**
     * @var BrandResourceModel
     */
    private BrandResourceModel $brandResourceModel;

    /**
     * Brand constructor.
     *
     * @param BrandFactory $brandFactory
     * @param BrandResourceModel $brandResourceModel
     */
    public function __construct(
        BrandFactory $brandFactory,
        BrandResourceModel $brandResourceModel
    ) {
        $this->brandFactory = $brandFactory;
        $this->brandResourceModel = $brandResourceModel;
    }

    /**
     * Returns brand data by code
     *
     * @param string $code
     * @return array
     * @throws NoSuchEntityException
     */
    public function getBrandDataByCode(string $code): array
    {
        //For performance view / m2 standard use with collection / pageRepository
        $brand = $this->brandFactory->create();
        $this->brandResourceModel->load($brand, $code, BrandInterface::CODE);

        if (!$brand->getId()) {
            throw new NoSuchEntityException(__('The Brand page with the "%1" ID doesn\'t exist.', $code));
        }

        return $this->convertBrandData($brand->getDataModel());
    }

    /**
     * Convert brand data
     *
     * @param BrandInterface $brand
     * @return array
     */
    private function convertBrandData(BrandInterface $brand): array
    {
        return [
            BrandInterface::BRAND_ID => $brand->getBrandId(),
            BrandInterface::CODE => $brand->getCode(),
            BrandInterface::NAME => $brand->getName(),
            BrandInterface::CREATED_AT => $brand->getCreatedAt(),
            BrandInterface::UPDATED_AT => $brand->getUpdatedAt()
        ];
    }
}
