<?php

namespace ozerich\shop\modules\admin\forms;

use ozerich\shop\models\Product;
use ozerich\shop\models\ProductImage;
use yii\base\Model;

class ProductMediaFormConvertor extends Model
{
    public function loadFormFromModel(Product $product)
    {
        $form = new ProductMediaForm();

        $form->video = $product->video;

        /** @var ProductImage[] $images */
        $images = ProductImage::find()
            ->andWhere('product_id=:product_id', [':product_id' => $product->id])
            ->all();

        $image_ids = [];
        foreach ($images as $image) {
            $image_ids[] = $image->image_id;
        }
        $form->images = $image_ids;

        return $form;
    }
}