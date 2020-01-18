<?php


namespace Liaosp\ArraySearch;


use Crasphb\Pagination;

class ArraySearch{
    /**
     * @var array
     */
    public $where=[];
    /**
     * @var array
     */
    public $orWhere=[];
    /**
     * @var int
     */
    public $page=1;
    /**
     * @var int
     */
    public $pageSize=2;
    /**
     * @var array
     */
    public $resArray = array();//查询的结果
    /**
     * @var
     */
    public $arrayData;//最开始的数组，二维数组
    /**
     * @var array
     */
    public $whereIn = array();

    public $pageConfig  = ['style' => 1,'simple'=>false,'allCounts'=>true,'nowAllPage'=>true,'toPage'=>true];

    /**
     * @param array $arrayData
     * @return $this
     */
    public function arrayData(array $arrayData){
        $this->arrayData = $arrayData;
        return $this;
    }
    /**
     *
     * @param array $where ['status'=>1,'status'=>2,'id'=>'1']
     * @return \ArraySearch
     */
    public function where(array $where){
        $this->where = array_merge($where,$this->where);
        return $this;
    }

    /**
     * @param array $where
     * @return $this
     */
    public function orWhere(array $where){
        $this->orWhere = array_merge($where,$this->orWhere);
        return $this;
    }

    /**
     * @param array $where ['status'=>[1,2,3]]
     * @return $this
     */
    public function whereIn(array $where){
        $this->whereIn = array_merge($where,$this->whereIn);
        return $this;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function get(){
        $this->common();
        return $this->arrayData;
    }

    /**
     * 獲取分頁
     * @param int $page
     * @return mixed
     * @throws \Exception
     */
    public function paginate($page=1){
        $this->page = $page;
        $this->common();
        if(empty($this->arrayData)){
            return [];
        }
        $obj =new Pagination($this->arrayData,$this->pageSize,$this->pageConfig);
        $obj->pageNow = $page;
        $this->arrayData =$obj->getItem();
        return $this->arrayData;
    }

    /**
     * 获取第三方扩展参数
     * @return  Pagination
     */
    public function Pagination(){

        $obj =new Pagination($this->arrayData,$this->pageSize,$this->pageConfig);
        $obj->pageNow = $this->page;
        return $obj;
    }

    /**
     * 公共处理
     * @throws \Exception
     */
    protected function common(){
        if(empty($this->arrayData)){
            throw new \Exception('数据为空，请调用arrayData 方法初始化数据');
        }
        if(!empty($this->where)){
            $this->arrayData = array_filter($this->arrayData, function($var){
                $bool = true;
                foreach ($this->where as $key=>$orwehre){
                    if($var[$key] != $orwehre){
                        $bool = false;
                    }
                }
                return $bool;
            });
        }
        if(!empty($this->whereIn)){
            $this->arrayData = array_filter( $this->arrayData, function($var){
                $bool = false;
                foreach ($this->whereIn as $key=>$orwehre){
                    if( in_array($var[$key],$orwehre)){
                        return true;
                        break;
                    }
                }
                return $bool;
            });
        }
        if(!empty($this->orWhere)){
            $this->arrayData = array_filter( $this->arrayData, function($var){
                $bool = false;
                foreach ($this->orWhere as $key=>$orwehre){
                    if($var[$key] == $orwehre){
                        return true;
                        break;
                    }
                }
                return $bool;
            });
        }
    }
}