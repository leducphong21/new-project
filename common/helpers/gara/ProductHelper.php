<?php

namespace common\helpers\gara;

use common\helpers\DataHelper;
use common\helpers\SystemHelper;
use common\models\gara\RepositoryReport;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use common\models\gara\stock\BillDetail;

class ProductHelper extends Inflector
{

    /*
     * Kiểm tra xem hàng hóa còn trong kho
     * */
    public static function getHasProduct($product_id)
    {
        $data = [
            'status' => false,
            'repo_id' => '',
            'repo_name' => '',
        ];
        //Filter Repository has Product
        $repoBillInfo = OtherHelper::getBillArray($product_id);

        $repoId = ArrayHelper::getColumn($repoBillInfo, 'repo_id');

        if ($repoId) {
            $repoName = ArrayHelper::getColumn($repoBillInfo, 'repo_name');
            $data = [
                'status' => true,
                'repo_id' => $repoId[0],
                'repo_name' => $repoName[0],
            ];
        }
        return $data;
    }

    /*
     * Hàm tính số lượng tồn kho của hàng hóa trong kho
     * */
    public static function getInventoryRepoProduct($product_id, $repo_id)
    {
        $sumQuery = 'sum(case when type = 1 then count  when type = 2 then -count END) total';
        $dataBill = BillDetail::find()
            //->select('ANY_VALUE(id) AS id, repo_id, product_id,  ANY_VALUE(repo_name) as repo_name, ' .$sumQuery) //Mysql 5.7
            //->select(['id', 'repo_id', 'repo_name', 'product_id', $sumQuery])
            ->where(['product_id' => $product_id, 'status' => STATUS_ACTIVE, 'repo_id' => $repo_id])
            //->andWhere(['total' => 0])
            ->groupBy(['product_id', 'repo_id'])
            ->asArray();

        //Process case Mysql Is 5.7
        if (SystemHelper::isMysql57()) {
            $dataBill->select('ANY_VALUE(id) AS id, repo_id, product_id, ANY_VALUE(repo_name) as repo_name'); //Mysql 5.7
        } else {
            $dataBill->select(['id', 'repo_id', 'repo_name', 'product_id', $sumQuery]);
        }

        if ($dataBill->one()) {
            return $dataBill['total'];
        }
        return 0;
    }

    /*
     * Danh sách sản phẩm còn trong kho
     * */
    public static function getProductInRepo($repo)
    {
        $sumQuery = 'sum(case when type = 1 then count  when type = 2 then -count END) total';
        $dataBill = BillDetail::find()
            //->select('ANY_VALUE(id) AS id, repo_id, product_id, ANY_VALUE(repo_name) as repo_name') //Mysql 5.7
            //->select(['id', 'repo_id', 'repo_name', 'product_id', $sumQuery])
            ->where(['status' => STATUS_ACTIVE, 'repo_id' => $repo])
            //->andWhere(['total' => 0])
            ->groupBy(['product_id', 'repo_id'])
            ->asArray();

        //Process case Mysql Is 5.7
        if (SystemHelper::isMysql57()) {
            $dataBill->select('ANY_VALUE(id) AS id, repo_id, product_id, ANY_VALUE(repo_name) as repo_name'); //Mysql 5.7
        } else {
            $dataBill->select(['id', 'repo_id', 'repo_name', 'product_id', $sumQuery]);
        }

        return $dataBill->all();
    }

    /*
     * Random Article ID
     * */
    public static function getRandomProductCategoryID()
    {
        $code = DataHelper::getRandomNumber();
        $model = (new \yii\db\Query())
            ->from('m_product_category')
            ->where('code=' . $code)
            ->one();
        if (!$model) {
            return $code;
        }
        return ProductHelper::getRandomProductCategoryID();
    }


}