<?php

namespace PhpDownloadManager;

use HtmlMediaFinder\RemoteXpathAdapter;

abstract class SeriesManager
{
	protected $seriesUrl;
	protected $seriesName;

	/**
	 * Use $this->seriesUrl and RemoteXpathAdapter to get the real series name from providing site
	 * method to overwrite
	 */
	abstract function remoteGetSeriesName();
	
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
}
