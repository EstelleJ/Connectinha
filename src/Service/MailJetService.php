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

		$mj = new \Mailjet\Client('4df62701ad677c66f54e9019fa42306a','b4ea54dd7ec0d36b08e064307e8374ca', true, ['version' => 'v3.1']);
		$body = [
				'Messages' => [
						[
								'From'             => [
										'Email' => "contact@connectinha.fr",
										'Name'  => "Connectinha",
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
