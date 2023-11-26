# M2-2.4.x Custom module using GraphQL(Query) - BrandGraphQL Module

This module ( **BrandGraphQL** ) returns information about brands using graphQL query.

**GraphQL Query:**

Query – is used to read or fetch values.

    * brandData (Query): – The brandData query returns information about Brand.

      File (schema.graphqls): Magento/BrandGraphQl/etc/schema.graphqls

    * Resolvers : A resolver performs GraphQL request processing.

        * In general, it is responsible for constructing a query, fetching data and performing any calculations, 
            then transforming the fetched and calculated data into a GraphQL array format.
            Finally, it returns the results wrapped by a callable function.

        * Resolver fetches the data and formats it according to the GraphQL schema.

        Resolver Files: 
            Resolver - \Magento\BrandGraphQl\Model\Resolver\Brand
            ResolverInterface - \Magento\Framework\GraphQl\Query\ResolverInterface

    * DataProvider: Returns and convert brand data by code.



**File Structure:**

```
-- BrandGraphQl
    |-- Model
    |   `-- Resolver
    |       |-- Brand.php
    |       `-- DataProvider
    |           `-- Brand.php
    |-- README.md
    |-- composer.json
    |-- etc
    |   |-- module.xml
    |   `-- schema.graphqls
    `-- registration.php
```

A GraphQL request is represented by the following arguments, which will be processed by a resolver:

```
    FIELD	    TYPE	                                                    DESCRIPTION
    $field	    Magento\Framework\GraphQl\Config\Element\Field	            Fields are used to describe possible values for a type/interface
    $context	    Magento\Framework\GraphQl\Query\Resolver\ContextInterface	    Resolver context is used as a shared data extensible object in all resolvers that implement ResolverInterface.
    $info	    Magento\Framework\GraphQl\Schema\Type\ResolveInfo	            Structure containing information useful for field resolution process.
    $value	    array	                                                    Contains additional query parameters. Null in most cases.
    $args	    array	                                                    Contains input arguments of query.

```

**Table: mdc_band**

```
+----------+-------------------+-------------------+---------------------+---------------------+
| brand_id | name              | code              | created_at          | updated_at          |
+----------+-------------------+-------------------+---------------------+---------------------+
|        2 | Brand Name        | brand_code        | 2021-06-27 11:58:34 | 2021-06-27 11:58:34 |
|        3 | Brand Name Second | brand_code_second | 2021-06-27 11:58:54 | 2021-06-27 11:58:54 |
+----------+-------------------+-------------------+---------------------+---------------------+
```

**Query:**

```
    * Method - Get
    
    * Syntax
        Return the contents of a brand: brandData(code: String): BrandItems

    * Payload/Request:
    
    {
      brandData(code: "brand_code") {
        brand_id
        code
        name
        created_at
        updated_at
      }
    }
    
    * Response:
    
    {
      "data": {
        "brandData": {
          "brand_id": 2,
          "code": "brand_code",
          "name": "Brand Name",
          "created_at": "2021-06-27 11:58:34",
          "updated_at": "2021-06-27 11:58:34"
        }
      }
    }
```

ChromeiQL:

![grpahql-brand-m2-2 4 2](https://user-images.githubusercontent.com/2525741/123555147-89690600-d7a1-11eb-9437-b63ed953787e.jpg)
