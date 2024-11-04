<?php
class WebPageScraper {
    private $url;
    private $dom;

    public function __construct($url) {
        $this->url = $url;
        $this->dom = new DOMDocument;
    }

    public function getDOM() {
        return $this->dom;
    }

    public function loadPage() {
        if ($this->url) {
            $html = file_get_contents($this->url);
            if ($html) {
                @$this->dom->loadHTML($html);
            } else {
                return null;
            }
            return $this->dom;
        } else {
            return null;
        }
    }

    public function findElementsByClass($className, $tagName = "*") {
        $xpath = new DOMXPath($this->dom);
        $query = "//" . $tagName . "[contains(@class, '$className')]";
        return $xpath->query($query);
    }

    public function getLatestNews() {
        $xpath = new DOMXPath($this->dom);
        //news_item
        $query = "//div[contains(@class, 'news_item')]"; 
        $newsItems = $xpath->query($query);
        return $newsItems->length > 0 ? $newsItems[0] : null;
    }

    public function getWeather() {
        $xpath = new DOMXPath($this->dom);
        // TemperatureValue 
        $query = "//span[contains(@class, 'TemperatureValue')]"; 
        $weather = $xpath->query($query);
        return $weather->length > 0 ? $weather[0] : null;
    }
}
?>
