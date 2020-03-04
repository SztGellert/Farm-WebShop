<?php
App::uses('Componenet','Controller');

class StatsComponent extends Component {
    public function summation($orders, $field) {
        $total=Hash::extract($orders, '{n}.Order.'.$field);
		return array_sum($total);
    }
    public function sumproducts($data,$amountmodel,$pricemodel) {
        $sum_p=0;
        foreach ($data as  $item) {
            $sum_p+=$item[$amountmodel]['amount']*$item[$pricemodel]['price'];
        }
        return $sum_p;
    } 
    public function calculatelinetotals(&$list,$amountmodel,$pricemodel) {
        foreach ($list as $key => $item) {
            $list[$key]["linetotal"]=$item[$amountmodel]['amount']*$item[$pricemodel]['price'];
        }
    }
}