<?php

namespace App\Service;

class PaginationService {

	public function pagination($elements, $nbElements) {
		$count = count($elements) / $nbElements;
		$round = ceil($count);

		$arrayPagination = [];
		$pagination = 1;

		for($pNumber = 0; $pNumber < $round; $pNumber++){
			array_push($arrayPagination, $pagination++);
		}

		return $arrayPagination;
	}


}

