<?php

namespace PhpDownloadManager;

class DownloadManager
{
	protected static $translation = [
		'en' => 'season',
		'de' => 'staffel'
	];
	
	protected $seriesManager;
	protected $seriesBasePath;
	protected $language;
	
	function __construct(SeriesManager $seriesManager, $seriesBasePath, $language = 'en') {
		$this->seriesManager = $seriesManager;
		$this->seriesBasePath = $seriesBasePath;
		$this->language = $language;
	}
	
	function getLatestEpisode() {
		return end(scandir($this->getSeriesPath() . DIRECTORY_SEPARATOR . $this->getLatestSeason()));
	}
	
	function getLatestSeason() {
// 		preg_match('/' . self::$translation[$this->language] . '\s[0-9]+/g', $subject, $matches);
	}
	
	function getSeasons() {
		return scandir($this->getSeriesPath());
	}
	
	function getSeriesPath() {
		return $this->seriesBasePath . DIRECTORY_SEPARATOR . $this->seriesManager->getSeriesName();
	}
	
	function run() {
		
	}
}
