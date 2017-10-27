<?php

class Basket {

    protected $_basket;
    protected $_items       = array();
    protected $_sum         = 0;
    
	public function __construct()
	{
        
		$this->_basket			= new Zend_Session_Namespace('basket');
		$this->_items			= $this->_basket->items;
	}
	
	public function addProduct( $pid, $quantity = 1 )
    {
        if ( !$this->_items[$pid] ){
            $this->_items[$pid] = $quantity;
        }
        else{
            $this->_items[$pid] += $quantity;
        }
		return true;
	}
	
	public function removeProduct( $pid )
    {
		if ( empty($this->_items)) {
			return false;
		}
		$key = array_search($pid, $this->_items);
        if ( $key )
            unset($this->_items[$key]);
		return true;
	}
	
	public function getItemsCount()
    {
		$_items_count = count($this->_items);
		return $_items_count;
    }
	
	public function getItems( $vat = true)
    {
		if ( $this->getItemsCount() == 0 ) {
			return false;
		}
		
		$this->_itemsList = array();

		$this->_db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$this->_itemsGroup = array_count_values($this->_items);
		
		foreach( $this->_itemsGroup as $ref => $quantity ) {
			
			$_result					= $this->_db->fetchRow('SELECT Name, Price, Ref FROM product WHERE ref = ?', $ref);
			$_result->quantity			= $quantity;
			$_result->unitPrice			= $_result->Price;
			$_result->totalByItem		= $_result->unitPrice * $_result->quantity;
			
			if ( $vat ) {
				$ShopTax 				= new ShopTax();
				$_result->unitPriceVat	= $ShopTax->applyTo($_result->Price);
				$_result->totalByItemVat= $_result->unitPriceVat * $_result->quantity;
			}
			else {
				$_result->unitPriceVat	= $_result->unitPrice;
				$_result->totalByItemVat= $_result->totalByItem;
			}

			unset($_result->Price);

			// On place les nouveaux attributs dans le tableau d'objets
			array_push($this->_itemsList, $_result);
			$this->_subTotal 	+= $_result->totalByItem;
			$this->_subTotalVat	+= $_result->totalByItemVat;
			$this->_sumVat		= $this->_subTotalVat - $this->_subTotal;
		}
		
		$this->_basket->subTotal 	= $this->_subTotal;
		$this->_basket->subTotalVat = $this->_subTotalVat;
		$this->_basket->sumVat		= $this->_sumVat;
	
		return $this->_itemsList;
    }
	
	public function genContentXml( $vat = true)
    {
		if ( !$this->getItemsCount() ) {
			return '';
		}
		
		if ( empty($this->_basket)) {
			$this->_basket = array();
		}
		
		$this->_db->setFetchMode(Zend_Db::FETCH_OBJ);
		
		$_contentXml = '<?xml version="1.0"?>'."";
		$_contentXml .= '<order>'."";
		
		$this->_itemsGroup = array_count_values($this->_items);
		
		foreach( $this->_itemsGroup as $ref => $quantity ) {
			$_result					= $this->_db->fetchRow('SELECT Name, Price, Ref FROM product WHERE ref = ?', $ref);
			$_result->quantity			= $quantity;
			$_result->unitPrice			= $_result->Price;
			$_result->totalByItem		= $_result->unitPrice * $_result->quantity;
			
			if ( $vat ) {
				$ShopTax 				= new ShopTax();
				$_result->unitPriceVat	= $ShopTax->applyTo($_result->Price);
				$_result->totalByItemVat= $_result->unitPriceVat * $_result->quantity;
			}
			else {
				$_result->unitPriceVat	= $_result->unitPrice;
				$_result->totalByItemVat= $_result->totalByItem;
			}

			unset($_result->Price);

			$_contentXml .= "\t".'<item>'."";
			$_contentXml .= "\t\t".'<reference>'.$_result->Ref.'</reference>'."";
			$_contentXml .= "\t\t".'<name>'.$_result->Name.'</name>'."";
			$_contentXml .= "\t\t".'<quantity>'.$_result->quantity.'</quantity>'."";
			$_contentXml .= "\t\t".'<unitprice>'.$_result->unitPrice.'</unitprice>'."";
			$_contentXml .= "\t\t".'<unitpricevat>'.$_result->unitPriceVat.'</unitpricevat>'."";
			$_contentXml .= "\t\t".'<totalbyitem>'.$_result->totalByItem.'</totalbyitem>'."";
			$_contentXml .= "\t\t".'<totalbyitemvat>'.$_result->totalByItemVat.'</totalbyitemvat>'."";
			$_contentXml .= "\t".'</item>'."";
			
			$this->_subTotal 	+= $_result->totalByItem;
			$this->_subTotalVat	+= $_result->totalByItemVat;
		}

		$this->_basket->subTotal 	= $this->_subTotal;
		$this->_basket->subTotalVat = $this->_subTotalVat;
		$this->_basket->sumVat		= $this->_subTotalVat - $this->_subTotal;
		
		$_contentXml .= '</order>';
		
		return $_contentXml;
    }
	
	public function getSubTotal()
    {
		return $this->_basket->subTotal;
    }

	public function getSubTotalVat()
    {
		return $this->_basket->subTotalVat;
    }
	
	public function getSumVat()
    {
		return $this->_basket->sumVat;
    }
	
	public function getSousTotalHt()
    {
		return $this->_sessionPanier->sousTotalHt;
    }
	
	public function getCurrency()
    {
		return $this->_basket->currency;
    }
	
	public function getTva()
    {
		return $this->_tva;
    }
	
	public function getDontTva() 
    {
		$_dontTva = round( ($this->_sessionPanier->sousTotalHt * $this->_tva) - $this->_sessionPanier->sousTotalHt ,2);
		$this->_sessionPanier->dontTva = $_dontTva;
		return $_dontTva;
    }
	
	public function clear()
    {
		$this->_basket->items = array();
		$this->_basket->subTotal = 0;
		$this->_basket->total = 0;
		return true;
    }
}