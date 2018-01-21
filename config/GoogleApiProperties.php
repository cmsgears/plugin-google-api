<?php
namespace cmsgears\google\api\config;

// CMG Imports
use cmsgears\core\common\config\CmgProperties;

class GoogleApiProperties extends CmgProperties {

	const CONFIG_GOOGLE_API			= 'google-api';

	const PROP_ACTIVE				= 'active';

	const PROP_TYPE					= 'type';

	const PROP_PROJECT_ID			= 'project_id';

	const PROP_PRIVATE_KEY_ID		= 'private_key_id';

	const PROP_PRIVATE_KEY			= 'private_key';

	const PROP_CLIENT_EMAIL			= 'client_email';

	const PROP_CLIENT_ID			= 'client_id';

	const PROP_AUTH_URI				= 'auth_uri';

	const PROP_TOKEN_URI			= 'token_uri';

	const PROP_AUTH_CERT_URL		= 'auth_provider_x509_cert_url';

	const PROP_CLIENT_CERT_URL		= 'client_x509_cert_url';

	// Singleton instance
	private static $instance;

	// Constructor and Initialisation ------------------------------

	/**
	 * Return Singleton instance.
	 */
	public static function getInstance() {

		if( !isset( self::$instance ) ) {

			self::$instance	= new GoogleApiProperties();

			self::$instance->init( self::CONFIG_GOOGLE_API);
		}

		return self::$instance;
	}

	public function isActive() {

		return $this->properties[ self::PROP_ACTIVE ];
	}

	public function getType() {

		return $this->properties[ self::PROP_TYPE ];
	}

	public function getProjectId() {

		return $this->properties[ self::PROP_PROJECT_ID ];
	}

	public function getPrivateKeyId() {

		return $this->properties[ self::PROP_PRIVATE_KEY_ID ];
	}

	public function getPrivateKey() {

		return $this->properties[ self::PROP_PRIVATE_KEY ];
	}

	public function getClientEmail() {

		return $this->properties[ self::PROP_CLIENT_EMAIL ];
	}

	public function getClientId() {

		return $this->properties[ self::PROP_CLIENT_ID ];
	}

	public function getAuthUri() {

		return $this->properties[ self::PROP_AUTH_URI ];
	}

	public function getTokenUri() {

		return $this->properties[ self::PROP_TOKEN_URI ];
	}

	public function getAuthCertUrl() {

		return $this->properties[ self::PROP_AUTH_CERT_URL ];
	}

	public function getClientCertUrl() {

		return $this->properties[ self::PROP_CLIENT_CERT_URL ];
	}

	public function getJsonString() {

		$apiObject = new \StdClass;

		$apiObject->type 			= $this->getType();
		$apiObject->project_id		= $this->getProjectId();
		$apiObject->private_key_id	= $this->getPrivateKeyId();
		$apiObject->private_key		= $this->getPrivateKey();
		$apiObject->client_email	= $this->getClientEmail();
		$apiObject->client_id		= $this->getClientId();
		$apiObject->auth_uri		= $this->getAuthUri();
		$apiObject->token_uri		= $this->getTokenUri();

		$apiObject->auth_provider_x509_cert_url	= $this->getAuthCertUrl();
		$apiObject->client_x509_cert_url		= $this->getClientCertUrl();

		return json_encode( $apiObject );
	}
}
