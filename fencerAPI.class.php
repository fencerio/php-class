<?php 

/**
 * PHP class for Fencer.io API
 * This source file is subject to the GPL license
 * See https://fencer.io/developers for more information
 *
 * @package 	Fencer.io
 * @author 	Ollie Phillips
 * @copyright 	Copyright (c) 2016 Fencer.io
 * @license 	http://www.gnu.org/licenses/gpl.txt
 * @version 	1.0 21/09/2016
 * 
*/

class fencerAPI {

	private $apiKey;
	private $accessKey;
	private $lat;
	private $lng;
	private $baseURI = "https://api.fencer.io/";
	private $version = "v1.0";

	public function __construct($apiKey, $accessKey = null, $lat = null, $lng = null, $version = null) {

		/**
		 * Constructor
		 *
		 * @param $apiKey string- Fencer API Key. Required
		 * @param $accessKey string - Geofence Access Key. Optional
		 * @param $lat float- Latitude, decimal notation. Optional
		 * @param $lng float - Longiture, decimal notiation. Optional
		 * @param $version string - API Version to use. Default is v1.0. Optional
		 */

		$this->apiKey = $apiKey;
		$this->accessKey = $accessKey;
		$this->lat = $lat;
		$this->lat = $lng;
		if (isset($version)) {
			$this->version = $version;
		}

	}

	public function getGeofences() {

		/**
		 * GET /geofence
		 *
		 * @return $data object
		 */

		$action = "geofence";
		$endPoint = $this->baseURI . $this->version . "/" . $action;
		return $this->request($endPoint);

	}

	public function getPublicGeofences() {
	
		/**
		 * GET /geofence/public
		 *
		 * NOT IMPLEMENTED
		 * @return $data string
		 */

		return "error";

	}

	public function navigateIn() {

		/**
		 * GET /navigation/in
		 *
		 * @return $data object
		 */

		$action = "navigation/in";
		$endPoint = $this->baseURI . $this->version . "/" . $action . "/" . $this->accessKey;
		return $this->request($endPoint);

	}

	public function navigateOrigin() {

		/**
		 * GET /navigation/origin
		 *
		 * @return $data object
		 */

		$action = "navigation/origin";
		$endPoint = $this->baseURI . $this->version . "/" . $action . "/" . $this->accessKey;
		return $this->request($endPoint);
	
	}

	public function navigateOut() {

		/**
		 * GET /navigation/out
		 *
		 * @return $data object
		 */

		$action = "navigation/out";
		$endPoint = $this->baseURI . $this->version . "/" . $action . "/" . $this->accessKey;
		return $this->request($endPoint);

	}

	public function position() {

		/**
		 * GET /position
		 *
		 * @return $object
		 */

		$action = "position";
		$endPoint = $this->baseURI . $this->version . "/" . $action;
		return $this->request($endPoint);

	}

	public function positionInside() {

		/**
		 * GET /position/inside
		 *
		 * @return $object
		 */

		$action = "position/inside";
		$endPoint = $this->baseURI . $this->version . "/" . $action . "/" . $this->accessKey;
		return $this->request($endPoint);
	
	}

	public function positionStatus() {

		/**
		 * GET /position/status
		 *
		 * @return $object
		 */

		$action = "position/status";
		$endPoint = $this->baseURI . $this->version . "/" . $action . "/" . $this->accessKey;
		return $this->request($endPoint);
	
	}

	public function setLat($lat) {

		/**
		 * Setter for latitude
		 *
		 * @param $lng float
		 */

		$this->lat = $lat;

	}

	public function setLng($lng) {

		/**
		 * Setter for longitude
		 *
		 * @param $lng float
		 */

		$this->lng = $lng;

	}

	public function setLatLng($lat, $lng) {

		/**
		 * Setter for latitude & longitude combined
		 *
		 * @param $lat float
		 * @param $lng float
		 */

		$this->lat = $lat; 
		$this->lng = $lng;

	}

	private function request($endPoint) {

		/**
		 * Request method which wraps curl
		 * @param $endPoint string - fully formed route to fencer.io API 
		 *
		 * @return $data object (or possibly a string at moment)
		 */

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $endPoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		if (isset($this->lat) && isset($this->lng)) {	
			// Lat/Lng supplied
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'Authorization: ' . $this->apiKey,
						'Lat-Pos: ' . $this->lat,
						'Lng-Pos:' . $this->lng
					)
			);
		} else {
			// Lat/Lng not supplied
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'Authorization: ' . $this->apiKey
					)
			);
		}
		$json = curl_exec($ch);
		$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		// Need more informative error info passed back
		// Returning "error" is sufficient for now
		if ($httpStatus != "200") {
			$data = "error";
		} else {
			$response = JSON_decode($json);
			if($response->data) {
				$data = $response->data;
			} else {
				$data = "error";
			}
		}

		return $data;

	}

}