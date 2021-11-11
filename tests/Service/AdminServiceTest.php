<?php

namespace App\Tests\Service;

use App\Service\AdminService;
use PHPUnit\Framework\TestCase;

class AdminServiceTest extends TestCase {

	public function testRemoveAccents() {

		$service = new AdminService();

		$this->assertEquals('Ca a marche', $service->remove_accents('Ça a marché'));
	}


	public function testSlugify() {

		$service = new AdminService();

		$this->assertEquals('categorie-vetements', $service->slugify(' Catégorie - Vêtements '));
	}
}
