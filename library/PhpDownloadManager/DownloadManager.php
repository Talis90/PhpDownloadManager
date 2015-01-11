<?php

namespace PhpDownloadManager;

class DownloadManager
{
	protected $fileManager;
	
	function __construct(SeriesManager $seriesManager, $seriesBasePath) {
		$this->fileManager = new FileManager($seriesManager, $seriesBasePath);
	}
	
	function run() {
		
	}
}
