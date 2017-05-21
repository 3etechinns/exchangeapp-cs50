<?php

class Stock_model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function get_quote() {
        $quote = $_POST['quote'];
        
        //receiving an array of data regarding name, price and symbol of stocks
        $stock = lookup($quote);
	$view = new View();
        
	if ($stock === FALSE) {
            $data['message'] = 'There is no such quote';
	    $view->render('templates/notice', $data);
            return FALSE;
	}
	else {
            $view->render('stock/quote_info', $stock);
	}
    }
    
    public function get_amount($stock, $cash) {
        $symbol = $_POST['symbol'];
        $shares = $_POST['shares'];
        
        $amount = $stock['price'] * $shares;
        if ($amount > $cash)
            return FALSE;
        
        return $amount;
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
    
    public function buy($id) {
        $symbol = $_POST['symbol'];
        $shares = $_POST['shares'];
        
        $query = $this->db->prepare("INSERT INTO portfolio (user_id, symbol, shares) "
                . "VALUES(:id, :symbol, :shares) "
                . "ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)");
        $query->execute(array(
           ':id' => $id,
            ':symbol' => $symbol,
            ':shares' => $shares
        ));
    }
    
    public function update_cash($id, $amount) {
        $query = $this->db->prepare("UPDATE users SET cash = cash - :amount WHERE id = :id");
        $query->execute(array(
           ':id' => $id,
            ':amount' => $amount
        ));
    }
    
    public function update_history($id, $shares, $price, $amount, $transaction) {
        $query = $this->db->prepare("INSERT INTO history (user_id, transaction, symbol, shares, price, cost, time) "
                . "VALUES(:id, :transaction, :symbol, :shares, :price, :cost, NOW())");
        $query->execute(array(
           ':id' => $id,
           ':transaction' => $transaction,
           ':symbol' => $_POST['symbol'],
           ':shares' => $shares,
           ':price' => $price,
           ':cost' => $amount,
        ));
    }
    
    public function get_history($id) {
        $query = $this->db->prepare("SELECT transaction, symbol, shares, price, cost, time "
                . "FROM history WHERE user_id = :id ORDER BY time DESC");
        $query->execute(array(
           ':id' => $id 
        ));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function get_shares_for_sell($id) {
        $query = $this->db->prepare("SELECT symbol FROM portfolio WHERE user_id = :id");
        $query->execute(array(
           ':id' => $id
        ));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function sell_shares($id, $symbol, $price) {
        $query = $this->db->prepare("SELECT shares FROM portfolio WHERE user_id = :id AND symbol = :symbol");
        $query->execute(array(
           ':id' => $id,
            'symbol' => $symbol
        ));
        $result = $query->fetch();
        
        $shares_cost = $price * $result['shares'];
        
        $query = $this->db->prepare("DELETE FROM portfolio WHERE user_id = :id AND symbol = :symbol LIMIT 1");
        $query->execute(array(
           ':id' => $id,
            'symbol' => $symbol
        ));
        
        return array('shares_cost' => $shares_cost, 'shares_number' => $result['shares']);
    }

}

