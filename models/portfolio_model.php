<?php

class Portfolio_model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function get_portfolio($id) {
        $query = $this->db->prepare("SELECT symbol, shares FROM portfolio WHERE user_id = :id");
        $query->execute(array(
           ':id' => $id 
        ));
        $rows = $query->fetchAll();
        
        $positions = [];
        foreach ($rows as $row) {
            $stock = lookup($row['symbol']);
            if ($stock !== FALSE) {
		$positions[] = [
		'name' => $stock['name'],
		'price' => $stock['price'],
		'shares' => $row['shares'],
		'symbol' => $row['symbol'],
		'cost' => $stock['price'] * $row['shares']
		];
            }
	}
        
        return $positions;
    }
    
    public function get_cash($id) {
        $query = $this->db->prepare("SELECT cash FROM users WHERE id = :id");
        $query->execute(array(
           ':id' => $id 
        ));
        $cash = $query->fetch(PDO::FETCH_ASSOC);
        $cash = $cash['cash'];
        return $cash;
    }
}

