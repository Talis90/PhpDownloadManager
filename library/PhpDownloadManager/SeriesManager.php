<?php

namespace PhpDownloadManager;

use HtmlMediaFinder\RemoteXpathAdapter;

class SeriesManager
{
	protected $seriesUrl;
	protected $seriesName;
	
	function setSeriesUrl($seriesUrl) {
		$this->seriesUrl = $seriesUrl;
		$this->seriesName = null;
	}
	
	function getSeriesUrl() {
		return $this->seriesUrl;
	}
	
	function getSeriesName() {
		if ($this->seriesName === null) {
			$this->seriesName = $this->remoteGetSeriesName();
		}
		return $this->seriesName;
	}
	
	/**
	 * method to overwrite
	 */
	function remoteGetSeriesName() {
		throw new \Exception(__METHOD__ . ' must be overwritten by child class!');
	}
}
