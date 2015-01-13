<?php

namespace PhpDownloadManager;

use HtmlMediaFinder\RemoteXpathAdapter;

abstract class SeriesManager
{
	protected $seriesUrl;
	protected $seriesName;
	protected $seasonsMap;
	
	function __construct($seriesUrl) {
		$this->seriesUrl = $seriesUrl;
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
	 * Get the seasons numbers
	 */
	abstract function getSeasons();
	
	/**
	 * Get the episode-urls of the given season
	 * @param int $season
	 */
	abstract function getEpisodeUrls($season);
	
	abstract function getVideoUrl($episodeUrl);

	/**
	 * Use $this->seriesUrl and RemoteXpathAdapter to get the real series name from providing site
	 * method to overwrite
	 */
	abstract protected function remoteGetSeriesName();
}
