<?php
/**
 * @author $Author: zhaozhe $(zhaozhe@babeltime.com)
 * @date $Date: 2020-09-14  14:13:57 +0800 (14, 2020-09-14) $
 * @version $Revision: 1 $
 * @brief
 *
 **/

/**
 * Class Dijkstra
 * 狄克斯特拉算法,解决加权图的最短路径问题,加权不能为负数。
 */
class Dijkstra
{
	protected $costs;
	protected $processed = array();

	public function search($graph, $parents, $costs)
	{
		$this->costs = $costs;
		$node = $this->find_lowest_cost_node();
		while ($node){
			$cost = $this->costs[$node];
			$neighbors = $graph[$node];
			foreach ($neighbors as $k => $v){
				$newCost = $cost + $v;
				if ($this->costs[$k] > $newCost){
					$this->costs[$k] = $newCost;
					$parents[$k] = $node;
				}
			}
			$this->processed[] = $node;
			$node = $this->find_lowest_cost_node();
		}

		return $parents;
	}

	private function find_lowest_cost_node()
	{
		$costs = $this->costs;
		$min = INF;
		$node = null;
		foreach ($costs as $k => $v){
			if ($v < $min && !in_array($k, $this->processed)){
				$min = $v;
				$node = $k;
			}
		}
		return $node;
	}
}

/**
 * search data
 */
$graph["start"]["a"] = 6;
$graph["start"]["b"] = 2;
$graph["a"]["fin"] = 1;
$graph["b"]["a"] = 3;
$graph["b"]["fin"] = 5;
$graph["fin"] = [];

$costs["a"] = 6;
$costs["b"] = 2;
$costs["fin"] = INF;

$parents["a"] = "start";
$parents["b"] = "start";
$parents["fin"] = null;
$dijkstra = new dijkstra();
var_dump($dijkstra->search($graph, $parents, $costs));