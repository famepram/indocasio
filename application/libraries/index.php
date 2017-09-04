<?php
require_once('class.stockMarketAPI.php');
$StockMarketAPI = new StockMarketAPI;
$StockMarketAPI->symbol = 'AAPL';
$StockMarketAPI->stat = 'all';
print_r($StockMarketAPI->getData());
?>