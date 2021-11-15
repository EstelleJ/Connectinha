<?php

namespace App\Service;

/*
This call sends a message based on a template.
*/

// require 'vendor/autoload.php';
use \Mailjet\Resources;

class MailJetService {

	/**
	 * @param $mailTo
	 * @param $firstName
	 * @param $subject
	 * @param $templateId
	 * @param $variables array tableau associatif des variables à afficher dans le template défini par templateId
	 */
	public function send($mailTo, $firstName, $subject, $templateId, array $variables) {

		$mj = new \Mailjet\Client('1b8c9998d2789abccf2c0cb0e15e6b4c','83a9a0d98ebe5ce522cf73ffc9568521', true, ['version' => 'v3.1']);
		$body = [
				'Messages' => [
						[
								'From'             => [
										'Email' => "contact@mindcursus.fr",
										'Name'  => "Mindcursus",
								],
								'To'               => [
										[
												'Email' => $mailTo,
												'Name'  => $firstName,
										],
								],
								'TemplateID'       => $templateId,
								'TemplateLanguage' => true,
								'Subject'          => $subject,
								'Variables'        => $variables,
								'CustomID'         => "AppGettingStartedTest",
						],
				],
		];
		$response = $mj->post(Resources::$Email, ['body' => $body]);
		$response->success() && dump($response->getData());

		return $response;
	}

}
