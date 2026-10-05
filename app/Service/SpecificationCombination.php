<?php 

namespace App\Service;
use Illuminate\Support\Facades\DB; 

Class SpecificationCombination
{
    public function syncVariantSpecifications()
{
    DB::transaction(function () {

        $combinations = DB::table('product_variant_combinations')
            ->select([
                'id',
                'product_id',
                'combination_id',
                'specialization',
            ])
            ->whereNotNull('product_id')
            ->whereNotNull('combination_id')
            ->whereNotNull('specialization')
            ->where('specialization', '!=', '')
            ->orderBy('id')
            ->get();

        foreach ($combinations as $combination) {

            $productId = (int) $combination->product_id;

            /*
             * combination_id DB me JSON array ke form me hai:
             *
             * [3]
             *
             * Hume single value nikalni hai:
             *
             * 3
             */
            $combinationIds = json_decode($combination->combination_id, true);

            if (!is_array($combinationIds) || empty($combinationIds)) {
                continue;
            }

            $combinationId = (int) $combinationIds[0];

            if ($combinationId < 1) {
                continue;
            }

            /*
             * product_variants se variant_id aur variant_value_id
             * product + combination_id ke basis par nikalna
             */
            $productVariant = DB::table('product_variants')
                ->where('product_id', $productId)
                ->first();

            if (!$productVariant) {
                continue;
            }

            /*
             * IMPORTANT:
             * content column combination_id se banega
             *
             * [3]  => content_3
             * [5]  => content_5
             * [14] => content_14
             */
            // if ($combinationId < 1 || $combinationId > 16) {
            //     continue;
            // }

            $contentColumn = 'content_' . $combinationId;

            /*
             * Specification insert
             */
            DB::table('product_variant_specifications')
                ->insert([
                    'product_id'       => $productId,
                    'variant_id'       => $productVariant->variant_id,
                    'variant_value_id' => $combinationId,
                    $contentColumn     => $combination->specialization,
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
        }
    });

    return response()->json([
        'success' => true,
        'message' => 'Product variant specifications synced successfully.'
    ]);
}
}



