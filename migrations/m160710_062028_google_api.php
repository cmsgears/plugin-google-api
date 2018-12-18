<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

// CMG Imports
use cmsgears\core\common\config\CoreGlobal;

use cmsgears\core\common\base\Migration;

use cmsgears\core\common\models\entities\Site;
use cmsgears\core\common\models\entities\User;
use cmsgears\core\common\models\resources\Form;
use cmsgears\core\common\models\resources\FormField;

use cmsgears\core\common\utilities\DateUtil;

/**
 * The google api migration inserts the base data required to query google apis enabled
 * for Service Account.
 *
 * @since 1.0.0
 */
class m160710_062028_google_api extends Migration {

	// Public Variables

	// Private Variables

	private $prefix;

	private $site;
	private $master;

	public function init() {

		// Table prefix
		$this->prefix	= Yii::$app->migration->cmgPrefix;

		$this->site		= Site::findBySlug( CoreGlobal::SITE_MAIN );
		$this->master	= User::findByUsername( Yii::$app->migration->getSiteMaster() );

		Yii::$app->core->setSite( $this->site );
	}

	public function up() {

		// Create various config
		$this->insertFileConfig();

		// Init default config
		$this->insertDefaultConfig();
	}

	private function insertFileConfig() {

		$this->insert( $this->prefix . 'core_form', [
			'siteId' => $this->site->id,
			'createdBy' => $this->master->id, 'modifiedBy' => $this->master->id,
			'name' => 'Config Google API', 'slug' => 'config-google-api',
			'type' => CoreGlobal::TYPE_SYSTEM,
			'description' => 'google configuration form.',
			'success' => 'Google API configurations saved successfully.',
			'captcha' => false,
			'visibility' => Form::VISIBILITY_PROTECTED,
			'status' => Form::STATUS_ACTIVE, 'userMail' => false,'adminMail' => false,
			'createdAt' => DateUtil::getDateTime(),
			'modifiedAt' => DateUtil::getDateTime()
		]);

		$config	= Form::findBySlugType( 'config-google-api', CoreGlobal::TYPE_SYSTEM );

		$columns = [ 'formId', 'name', 'label', 'type', 'compress', 'meta', 'active', 'validators', 'order', 'icon', 'htmlOptions' ];

		$fields	= [
			[ $config->id, 'active', 'Active', FormField::TYPE_TOGGLE, false, true, true, 'required', 0, NULL, '{"title":"Active"}' ],
			[ $config->id, 'type', 'Type', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Type","placeholder":"Type"}' ],
			[ $config->id, 'project_id', 'Project Id', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Project Id","placeholder":"Project Id"}' ],
			[ $config->id, 'private_key_id', 'Private Key Id', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Private Key Id","placeholder":"Private Key Id"}' ],
			[ $config->id, 'private_key', 'Private Key', FormField::TYPE_PASSWORD, false, true, true, 'required', 0, NULL, '{"title":"Private Key","placeholder":"Private Key"}' ],
			[ $config->id, 'client_email', 'Client Email', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Client Email","placeholder":"Client Email"}' ],
			[ $config->id, 'client_id', 'Client Id', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Client Id","placeholder":"Client Id"}' ],
			[ $config->id, 'auth_uri', 'Auth URI', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Auth URI","placeholder":"Auth URI"}' ],
			[ $config->id, 'token_uri', 'Token URI', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Token URI","placeholder":"Token URI"}' ],
			[ $config->id, 'auth_provider_x509_cert_url', 'Auth Provider X509 Cert Url', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Auth Cert Url","placeholder":"Auth Cert Url"}' ],
			[ $config->id, 'client_x509_cert_url', 'Client X509 Cert Url', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Client Cert Url","placeholder":"Client Cert Url"}' ]
		];

		$this->batchInsert( $this->prefix . 'core_form_field', $columns, $fields );
	}

	private function insertDefaultConfig() {

		$columns = [ 'modelId', 'name', 'label', 'type', 'active', 'valueType', 'value', 'data' ];

		$metas	= [
			[ $this->site->id, 'active', 'Active', 'google-api', 1, 'flag', '0', NULL ],
			[ $this->site->id, 'type', 'Type', 'google-api', 1, 'text', NULL, NULL ],
			[ $this->site->id, 'project_id', 'Project Id', 'google-api', 1, 'text', NULL, NULL ],
			[ $this->site->id, 'private_key_id', 'Private Key Id', 'google-api', 1, 'text', NULL, NULL ],
			[ $this->site->id, 'private_key', 'Private Key', 'google-api', 1, 'text', NULL, NULL ],
			[ $this->site->id, 'client_email', 'Client Email', 'google-api', 1, 'text', NULL, NULL ],
			[ $this->site->id, 'client_id', 'Client Id', 'google-api', 1, 'text', NULL, NULL ],
			[ $this->site->id, 'auth_uri', 'Auth URI', 'google-api', 1, 'text', '5', NULL ],
			[ $this->site->id, 'token_uri', 'Token URI', 'google-api', 1, 'text', '5', NULL ],
			[ $this->site->id, 'auth_provider_x509_cert_url', 'Auth Provider X509 Cert Url', 'google-api', 1, 'text', '5', NULL ],
			[ $this->site->id, 'client_x509_cert_url', 'Client X509 Cert Url', 'google-api', 1, 'text', '5', NULL ]
		];

		$this->batchInsert( $this->prefix . 'core_site_meta', $columns, $metas );
	}

	public function down() {

		echo "m160710_062028_google_api will be deleted with m160621_014408_core.\n";

		return true;
	}

}
