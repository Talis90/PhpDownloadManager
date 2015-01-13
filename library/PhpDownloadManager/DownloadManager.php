<?php

namespace PhpDownloadManager;

use HtmlMediaFinder\HtmlMediaFinder;
class DownloadManager
{
	protected static $translation = [
		'en' => 'season',
		'de' => 'staffel'
	];
	
	protected $seriesManagers = [];
	protected $currentManager;
	protected $seriesBasePath;
	protected $language;
	
	function __construct($seriesBasePath, $language = 'en') {
		$this->seriesBasePath = $seriesBasePath;
		$this->language = $language;
	}
	
	function addSeriesManager(SeriesManager $seriesManager) {
		$this->seriesManagers[] = $seriesManager;
	}
	
	/**
	 * @return \PhpDownloadManager\SeriesManager
	 */
	function getCurrentSeriesManager() {
		if ($this->currentManager === null) {
			$this->currentManager = reset(array_keys($this->seriesManagers));
		}
		return $this->seriesManagers[$this->currentManager];
	}
	
	function getEpisodePath($season, $episode) {
		return $this->getSeasonPath($season) . DIRECTORY_SEPARATOR . 's' . sprintf('%02d', $season) . 'e' . sprintf('%02d', $episode);
	}
	
	function getSeasonPath($season) {
		$path = $this->getSeriesPath() . DIRECTORY_SEPARATOR . self::$translation[$this->language] . ' ' . $season;
		if (!is_dir($path)) {
			mkdir($path);
		}
		return $path;
	}
	
	function getSeriesPath() {
		$path = $this->seriesBasePath . DIRECTORY_SEPARATOR . $this->getCurrentSeriesManager()->getSeriesName();
		if (!is_dir($path)) {
			mkdir($path);
		}
		return $path;
	}
	
	function run() {
		$seasons = $this->getCurrentSeriesManager()->getSeasons();
		foreach ($seasons as $season) {
			$urls = $this->getCurrentSeriesManager()->getEpisodeUrls($season);
			foreach ($urls as $episode => $url) {
				$episodeFile = $this->getEpisodePath($season, $episode);
				if (!glob($episodeFile . '.*')) {
					$videoUrl = $this->getCurrentSeriesManager()->getVideoUrl($url);
					$downloadUrl = HtmlMediaFinder::getDownloadUrl($videoUrl);
					preg_match('/\..{3}$/U', $downloadUrl, $matches);
					$fileEnding = reset($matches);
					echo 'downloading ' . $episodeFile . $fileEnding . "\n";
					file_put_contents($episodeFile . $fileEnding, file_get_contents($downloadUrl));
					echo 'completed.' . "\n";
				}
			}
		}
	}
}
