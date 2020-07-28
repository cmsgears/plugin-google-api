<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\google\api\config;

/**
 * GoogleApiProperties provide methods to access the properties specific to Google APIs.
 *
 * It also generate the JSON string required to query the Service Account APIs.
 *
 * @since 1.0.0
 */
class GoogleApiProperties extends \cmsgears\core\common\config\Properties {

	// Variables ---------------------------------------------------

	// Globals ----------------

	const CONFIG_GOOGLE_API = 'google-api';

	const PROP_ACTIVE = 'active';

	const PROP_TYPE = 'type';

	const PROP_PROJECT_ID = 'project_id';

	const PROP_PRIVATE_KEY_ID	= 'private_key_id';
	const PROP_PRIVATE_KEY		= 'private_key';

	const PROP_CLIENT_EMAIL	= 'client_email';
	const PROP_CLIENT_ID	= 'client_id';

	const PROP_AUTH_URI		= 'auth_uri';
	const PROP_TOKEN_URI	= 'token_uri';

	const PROP_AUTH_CERT_URL = 'auth_provider_x509_cert_url';

	const PROP_CLIENT_CERT_URL	= 'client_x509_cert_url';

	// Public -----------------

	// Protected --------------

	// Private ----------------

	private static $instance;

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	/**
	 * Return Singleton instance.
	 */
	public static function getInstance() {

		if( !isset( self::$instance ) ) {

			self::$instance	= new GoogleApiProperties();

			self::$instance->init( self::CONFIG_GOOGLE_API );
		}

		return self::$instance;
	}

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// GoogleApiProperties -------------------

	/**
	 * Check whether Google APIs are enabled.
	 *
	 * @return boolean
	 */
	public function isActive() {

		return $this->properties[ self::PROP_ACTIVE ];
	}

	/**
	 * Return the type of APIs. It must be set to service_account.
	 *
	 * @return string
	 */
	public function getType() {

		return $this->properties[ self::PROP_TYPE ];
	}

	/**
	 * Return the Project Id of project on Google Cloud Platform.
	 *
	 * @return string
	 */
	public function getProjectId() {

		return $this->properties[ self::PROP_PROJECT_ID ];
	}

	/**
	 * Returns the private key id.
	 *
	 * @return string
	 */
	public function getPrivateKeyId() {

		return $this->properties[ self::PROP_PRIVATE_KEY_ID ];
	}

	/**
	 * Returns the private key.
	 *
	 * @return string
	 */
	public function getPrivateKey() {

		return $this->properties[ self::PROP_PRIVATE_KEY ];
	}

	/**
	 * Returns client email.
	 *
	 * @return string
	 */
	public function getClientEmail() {

		return $this->properties[ self::PROP_CLIENT_EMAIL ];
	}

	/**
	 * Returns client id.
	 *
	 * @return string
	 */
	public function getClientId() {

		return $this->properties[ self::PROP_CLIENT_ID ];
	}

	/**
	 * Returns Auth URI.
	 *
	 * @return string
	 */
	public function getAuthUri() {

		return $this->properties[ self::PROP_AUTH_URI ];
	}

	/**
	 * Returns Token URI.
	 *
	 * @return string
	 */
	public function getTokenUri() {

		return $this->properties[ self::PROP_TOKEN_URI ];
	}

	/**
	 * Returns Auth Cert URL.
	 *
	 * @return string
	 */
	public function getAuthCertUrl() {

		return $this->properties[ self::PROP_AUTH_CERT_URL ];
	}

	/**
	 * Returns Client Cert URL.
	 *
	 * @return string
	 */
	public function getClientCertUrl() {

		return $this->properties[ self::PROP_CLIENT_CERT_URL ];
	}

	/**
	 * Returns the JSON string required to query the APIs.
	 *
	 * @return string
	 */
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
