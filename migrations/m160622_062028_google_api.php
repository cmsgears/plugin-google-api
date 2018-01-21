<?php
// CMG Imports
use cmsgears\core\common\config\CoreGlobal;

use cmsgears\core\common\models\entities\Site;
use cmsgears\core\common\models\entities\User;
use cmsgears\core\common\models\resources\Form;
use cmsgears\core\common\models\resources\FormField;

use cmsgears\core\common\utilities\DateUtil;

class m160622_062028_google_api extends \yii\db\Migration {

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
				'successMessage' => 'Google API configurations saved successfully.',
				'captcha' => false,
				'visibility' => Form::VISIBILITY_PROTECTED,
				'active' => true, 'userMail' => false,'adminMail' => false,
				'createdAt' => DateUtil::getDateTime(),
				'modifiedAt' => DateUtil::getDateTime()
		]);

		$config	= Form::findBySlug( 'config-google-api', CoreGlobal::TYPE_SYSTEM );

		$columns = [ 'formId', 'name', 'label', 'type', 'compress', 'validators', 'order', 'icon', 'htmlOptions' ];

		$fields	= [
				[ $config->id, 'active', 'Active', FormField::TYPE_TOGGLE, false, 'required', 0, NULL, '{"title":"Active"}' ],
				[ $config->id, 'type', 'Type', FormField::TYPE_TEXT, false, 'required', 0, NULL, '{"title":"Type","placeholder":"Type"}' ],
				[ $config->id, 'project_id', 'Project Id', FormField::TYPE_TEXT, false, 'required', 0, NULL, '{"title":"Project Id","placeholder":"Project Id"}' ],
				[ $config->id, 'private_key_id', 'Private Key Id', FormField::TYPE_TEXT, false, 'required', 0, NULL, '{"title":"Private Key Id","placeholder":"Private Key Id"}' ],
				[ $config->id, 'private_key', 'Private Key', FormField::TYPE_TEXT, false, 'required', 0, NULL, '{"title":"Private Key","placeholder":"Private Key"}' ],
				[ $config->id, 'client_email', 'Client Email', FormField::TYPE_TEXT, false, 'required', 0, NULL, '{"title":"Client Email","placeholder":"Client Email"}' ],
				[ $config->id, 'client_id', 'Client Id', FormField::TYPE_TEXT, false, 'required', 0, NULL, '{"title":"Client Id","placeholder":"Client Id"}' ],
				[ $config->id, 'auth_uri', 'Auth URI', FormField::TYPE_TEXT, false, 'required', 0, NULL, '{"title":"Auth URI","placeholder":"Auth URI"}' ],
				[ $config->id, 'token_uri', 'Token URI', FormField::TYPE_TEXT, false, 'required', 0, NULL, '{"title":"Token URI","placeholder":"Token URI"}' ],
				[ $config->id, 'auth_provider_x509_cert_url', 'Auth Provider X509 Cert Url', FormField::TYPE_TEXT, false, 'required', 0, NULL, '{"title":"Auth Cert Url","placeholder":"Auth Cert Url"}' ],
				[ $config->id, 'client_x509_cert_url', 'Client X509 Cert Url', FormField::TYPE_TEXT, false, 'required', 0, NULL, '{"title":"Client Cert Url","placeholder":"Client Cert Url"}' ]
		];

		$this->batchInsert( $this->prefix . 'core_form_field', $columns, $fields );
	}

	private function insertDefaultConfig() {

		$columns = [ 'modelId', 'name', 'label', 'type', 'valueType', 'value' ];

		$metas	= [
				[ $this->site->id, 'active', 'Active', 'google-api', 'flag', '0' ],
				[ $this->site->id, 'type', 'Type', 'google-api', 'text', NULL ],
				[ $this->site->id, 'project_id', 'Project Id', 'google-api', 'text', NULL ],
				[ $this->site->id, 'private_key_id', 'Private Key Id', 'google-api', 'text', NULL ],
				[ $this->site->id, 'private_key', 'Private Key', 'google-api', 'text', NULL ],
				[ $this->site->id, 'client_email', 'Client Email', 'google-api', 'text', NULL ],
				[ $this->site->id, 'client_id', 'Client Id', 'google-api', 'text', NULL ],
				[ $this->site->id, 'auth_uri', 'Auth URI', 'google-api', 'text', '5' ],
				[ $this->site->id, 'token_uri', 'Token URI', 'google-api', 'text', '5' ],
				[ $this->site->id, 'auth_provider_x509_cert_url', 'Auth Provider X509 Cert Url', 'google-api', 'text', '5' ],
				[ $this->site->id, 'client_x509_cert_url', 'Client X509 Cert Url', 'google-api', 'text', '5' ]
		];

		$this->batchInsert( $this->prefix . 'core_site_meta', $columns, $metas );
	}

	public function down() {

		echo "m160622_062028_google_api will be deleted with m160621_014408_core.\n";

		return true;
	}
}
