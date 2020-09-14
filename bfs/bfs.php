<?php
/**
 * @author $Author: zhaozhe $(zhaozhe@babeltime.com)
 * @date $Date: 2020-09-14  11:15:54 +0800 (14, 2020-09-14) $
 * @version $Revision: 1 $
 * @brief
 *
 **/

/**
 * Class Bfs
 * 广度优先算法解决是否有最短路径,找出最短路径。
 */
class Bfs
{
	protected $parent;
	public function search($data, $name, $isPath)
	{
		$queue = new SplQueue();
		foreach ($data[$name] as $v){
			$this->parent[$name] = $v;
			$queue->enqueue($v);
		}
		$checked[] = $name;
		while (!$queue->isEmpty()){
			$checkName = $queue->dequeue();
			if (!in_array($checkName, $checked)){
				if ($this->isSeller($checkName)){
					if ($isPath){
						$res = array();
						$this->returnPath($this->parent, $checkName, $res);
						return $res;
					}else{
						return true;
					}
				}else{
					if (!empty($data[$checkName])){
						foreach ($data[$checkName] as $v){
							$this->parent[$checkName] = $v;
							$queue->enqueue($v);
						}
					}
				}
			}
		}
		return false;
	}

	private function isSeller($name)
	{
		$len = strlen($name);
		if ($name[$len - 1] == "m"){
			return true;
		}

		return false;
	}

	private function returnPath($parents, $name, &$res)
	{
		if (!in_array($name, $parents)){
			return ;
		}
		$newArr = array();
		foreach ($parents as $k => $v){
			$newArr[$k] = $v;
			if ($v == $name){
				$res[$k] = $v;
				return $this->returnPath($newArr, $k, $res);
			}
		}
	}
}

/**
 * search data, Graph
 */
$graph["you"] = ["alice", "bob", "claire"];
$graph["bob"] = ["peggy", "anuj"];
$graph["alice"] = ["peggy"];
$graph["claire"] = ["tho", "jonn"];
$graph["anuj"] = [];
$graph["peggy"] = [];
$graph["tho"] = [];
$graph["jonn"] = ["jam"];
$bfs = new Bfs();
var_dump($bfs->search($graph, "you", true));