<?php

class Produit_Model_Basket {

    protected $_basket;
    protected $_items       = array();
    protected $_sum         = 0;
    
	public function __construct()
	{
        
		$this->_basket			= new Zend_Session_Namespace('basket');
		$this->_items			= $this->_basket->items;
        !is_array( $this->_items ) ? $this->_items = array(): true;
               
	}
	
	public function addProduct( $pid, $quantity = 1 )
    {
        if ( !$this->_items[$pid] ){
            $this->_items[$pid] = $quantity;
        }
        else{
            $this->_items[$pid] += $quantity;
        }
        $this->_basket->items = $this->_items;
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
        $this->_basket->items = $this->_items;
		return true;
	}
	
	public function updateQuantity( $pid, $quantity )
    {
		if ( empty($this->_items)) {
			return false;
		}
		$key = array_search( (int) $pid, $this->_items);
        if ( $key )
            $this->_items[$key] = $quantity;
        $this->_basket->items = $this->_items;
		return $this;
	}
    
	public function increaseQuantity( $pid )
    {
		if ( empty($this->_items)) {
			return false;
		}
		$key = array_search( (int) $pid, $this->_items);
        if ( $key )
            $this->_items[$key] += 1;
        $this->_basket->items = $this->_items;
		return $this;
	}
    
	public function decreaseQuantity( $pid )
    {
		if ( empty($this->_items)) {
			return false;
		}
		$key = array_search( (int) $pid, $this->_items);
        if ( $key )
            $this->_items[$key] -= 1;
        $this->_basket->items = $this->_items;
		return $this;
	}
    
	public function getItemsCount() 
    {
        $itemsCount = 0;
        foreach( $this->_items as $item ){
            $itemsCount += (int) $item;
        }
		return $itemsCount;
    }
	
	public function getItems()
    {
		if ( $this->getItemsCount() == 0 ) {
			return false;
		}
		
		$itemsList = array();

        $ProduitsTable    = new Produit_Model_Mapper_Unite();

        $currency         = new Zend_Currency( Zend_Registry::get('config')->locale->default );
        foreach( $this->_items as $item => $quantity ){
            $Produit      = new Produit_Model_Unite();
            $ProduitsTable->find( $item , $Produit);
            $entry['id']            = $Produit->getId();
            $entry['name']          = $Produit->getTitre();
            $entry['unitPrice']     = $Produit->getPrix();
            $entry['unitBois']     = $Produit->getBois();
            $entry['unitMana']     = $Produit->getMana();
            $entry['image']     = $Produit->getImage();
            $entry['unitPopulation']     = $Produit->getPopulation();
            $entry['quantity']      = $quantity;
            $entry['victoire']      = $Produit->getVictoire();
            $entry['duree']      = $Produit->getDuree();
            $entry['sum']           = $currency->toCurrency($quantity * $Produit->getPrix()) . ' HT';
            $itemsList[]            = $entry;
        }
		return $itemsList;
    }
	
	public function genContentXml( $vat = true)
    {
		if ( !$this->getItemsCount() ) {
			return false;
		}
		
		if ( empty($this->_basket)) {
			$this->_basket = array();
		}
		
		
		$contentXml = '<?xml version="1.0"?>'."";
		$contentXml .= '<order>'."";
		
        $ProduitTable   = new Produit_Model_Mapper_Unite();
        $Produit        = new Produit_Model_unite();
		foreach( $this->_basket->items as $pid => $quantity ) {
        
			$ProduitTable->find( $pid, $Produit );
            
			$entry->quantity			= $quantity;
			$entry->unitPrice			= $Produit->getPrix();
			$entry->rowSum       		= $entry->unitPrice * $entry->quantity;
			
			if ( $vat ) {
				$Tax    				= new Produit_Model_Taxe();
				$entry->unitPriceVat	= $Tax->applyTo($entry->unitPrice);
				$entry->rowSumVat       = $entry->unitPriceVat * $entry->quantity;
			}
			else {
				$_result->unitPriceVat	= $entry->unitPrice;
				$_result->rowSumVat     = $entry->totalByItem;
			}


			$_contentXml .= "\t".'<item>'."";
			$_contentXml .= "\t\t".'<reference>' . $entry->getId() . '</reference>'."";
			$_contentXml .= "\t\t".'<name>' . $entry->getTitre() . '</name>'."";
			$_contentXml .= "\t\t".'<quantity>'.$entry->quantity.'</quantity>'."";
			$_contentXml .= "\t\t".'<unitprice>'.$entry->unitPrice.'</unitprice>'."";
			$_contentXml .= "\t\t".'<unitpricevat>'.$entry->unitPriceVat.'</unitpricevat>'."";
			$_contentXml .= "\t\t".'<totalbyitem>'.$entry->rowSum.'</totalbyitem>'."";
			$_contentXml .= "\t\t".'<totalbyitemvat>'.$_result->rowSumVat.'</totalbyitemvat>'."";
			$_contentXml .= "\t".'</item>'."";
			
			$this->_subTotal 	+= $_result->rowSum;
			$this->_subTotalVat	+= $_result->rowSumVat;
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
	
	public function getCurrency()
    {
		return $this->_basket->currency;
    }
	
	public function clear()
    {
		$this->_basket->items = array();
		$this->_basket->subTotal = 0;
		$this->_basket->total = 0;
		return true;
    }
}