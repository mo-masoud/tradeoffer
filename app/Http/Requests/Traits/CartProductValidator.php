<?php

namespace App\Http\Requests\Traits;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

trait CartProductValidator
{
    /**
     * @throws ValidationException
     */
    public function validatedProducts(): Collection
    {
        $products = Product::with([
            'attributes.attribute',
            'addons',
            'media',
            'store',
            'categories.parent',
            'colors',
            'sizes',
            'offers'
        ])->whereIn('id', $this->input('products.*.id'))
            ->orderByRaw("FIELD(id, {$this->orderedIds()})")
            ->get();

        foreach ($products as $index => $product) {
            $this->validateProductIfHasCorrectData($index, $product);
        }
        return $products;
    }

    /**
     * @param int $index
     * @param Product $product
     * @return void
     * @throws ValidationException
     */
    public function validateProductIfHasCorrectData(int $index, Product $product): void
    {
        $this->validateIfProductHasSize($index, $product);
        $this->validateIfProductHasColor($index, $product);
        $this->validateIfTheProductHasTheAttributeValue($index, $product);
        $this->validateIfTheProductHasTheAddon($index, $product);
    }

    /**
     * @param int $index
     * @param Product $product
     * @return void
     * @throws ValidationException
     */
    public function validateIfProductHasSize(int $index, Product $product): void
    {
        if ($this->input('products.*.size_id')[$index]) {
            if (!$product->sizes->contains('id', $this->input('products.*.size_id')[$index])) {
                throw ValidationException::withMessages([
                    'products.' . $index . '.size_id' => 'Invalid size for product ' . $product->name
                ]);
            }
        }

        // validate if product has size then user must select the size
        if ($product->sizes->isNotEmpty() && !$this->input('products.*.size_id')[$index]) {
            throw ValidationException::withMessages([
                'products.' . $index . '.size_id' => 'Size is required for product ' . $product->name
            ]);
        }
    }

    /**
     * @param int $index
     * @param Product $product
     * @return void
     * @throws ValidationException
     */
    public function validateIfProductHasColor(int $index, Product $product): void
    {
        if ($this->input('products.*.color_id')[$index]) {
            if (!$product->colors->contains('id', $this->input('products.*.color_id')[$index])) {
                throw ValidationException::withMessages([
                    'products.' . $index . '.color_id' => 'Invalid color for product ' . $product->name
                ]);
            }
        }

        // validate if product has color then user must select the color
        if ($product->colors->isNotEmpty() && !$this->input('products.*.color_id')[$index]) {
            throw ValidationException::withMessages([
                'products.' . $index . '.color_id' => 'Color is required for product ' . $product->name
            ]);
        }
    }

    /**
     * @param int $index
     * @param Product $product
     * @return void
     * @throws ValidationException
     */
    protected function validateIfTheProductHasTheAttributeValue(int $index, Product $product): void
    {
        // validate if the product has the attribute value
        if ($this->input('products.*.attribute_id')[$index]) {
            $attribute = $product->attributes->firstWhere('id', $this->input('products.*.attribute_id')[$index]);
            if (!$attribute) {
                throw ValidationException::withMessages([
                    'products.' . $index . '.attribute_id' => 'Invalid attribute for product ' . $product->name
                ]);
            }
        }

        // validate if product has attribute value then user must select the attribute value
        if ($product->attributes->isNotEmpty() && !$this->input('products.*.attribute_id')[$index]) {
            throw ValidationException::withMessages([
                'products.' . $index . '.attribute_id' => 'Attribute is required for product ' . $product->name
            ]);
        }
    }

    /**
     * @param int $index
     * @param Product $product
     * @return void
     * @throws ValidationException
     */
    protected function validateIfTheProductHasTheAddon(int $index, Product $product): void
    {
        if ($this->input('products.*.addons')[$index]) {
            foreach ($this->input('products.*.addons')[$index] as $addon) {
                if (!$product->addons->contains('id', $addon['id'])) {
                    throw ValidationException::withMessages([
                        'products.' . $index . '.addons' => 'Invalid addon for product ' . $product->name
                    ]);
                }
            }
        }
    }
}
