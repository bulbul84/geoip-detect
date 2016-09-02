<?php

namespace YellowTree\GeoipDetect\Geonames;
define ('GEOIP_DETECT_GEONAMES_COUNTRY_INFO', GEOIP_PLUGIN_DIR . '/lib/geonames/data/country-info.php');
define ('GEOIP_DETECT_GEONAMES_COUNTRY_NAMES', GEOIP_PLUGIN_DIR . '/lib/geonames/data/country-names.php');

class CountryInformation {
	
	protected $data = [];
	
	protected function lazyLoadInformation($filename) {
		if (!isset($this->data[$filename])) {
			$this->data[$filename] = require($filename);
		}
		return $this->data[$filename];
	}
	/**
	 * Get all geonames Information that is known about the country with this ISO code.
	 * 
	 * @param string $iso 2-letter ISO-Code of the country (e.g. 'DE')
	 * @return array Information in record format
	 */
	public function getInformationAboutCountry($iso) {
		$data = $this->lazyLoadInformation(GEOIP_DETECT_GEONAMES_COUNTRY_INFO);
		
		return isset($data[$iso]) ? $data[$iso] : [];
	}
	
	/**
	 * Get all country names
	 * @param  string/array $locales Locale of the label (if array: use the first locale available)
	 * @return array ISO Codes => Label Pairs
	 */
	public function getAllCountries($locales) {
		$data = $this->lazyLoadInformation(GEOIP_DETECT_GEONAMES_COUNTRY_NAMES);

		foreach ($locales as $locale) {
			if (isset($data[$locale]))
				return $data[$locale];
		}
		return [];
	}
}

// List of country names, iso, continent id.
// List of continents

// List of timezones