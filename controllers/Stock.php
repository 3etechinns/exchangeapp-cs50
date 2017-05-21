<?php

class Stock extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        if (Session::get('logged_in') === TRUE) {
            $this->view->render('login/portfolio');
            return FALSE;
        } else {
            $this->view->render('index/index');
        }
    }
    
    public function quote() {
        if (Session::get('logged_in') === FALSE) {
            $this->view->render('index/index');
            return FALSE;
        }
        $this->view->render('stock/quote');
    }
    
    public function get_quote() {
        if (Session::get('logged_in') === FALSE) {
            $this->view->render('index/index');
            return FALSE;
        }
        if(isset($_POST['quote'])) {
            if(!empty($_POST['quote'])) {
                $this->model->get_quote();
            } else {
                $this->view->render('stock/quote');
                return FALSE;
            }
        }
    }
    
    public function get_buy() {
        if (Session::get('logged_in') === FALSE) {
            $this->view->render('index/index');
            return FALSE;
        }
        $this->view->render('stock/buy');
    }
    
    public function buy() {
        if (Session::get('logged_in') === FALSE) {
            $this->view->render('index/index');
            return FALSE;
        }
        
        if(isset($_POST['symbol']) && isset($_POST['shares'])) {
            if(!empty($_POST['symbol']) && !empty($_POST['shares'])) {
                
                //check for integers in 'shares'
                if (!preg_match("/^\d+$/", $_POST['shares'])) {
                    $data['message'] = 'Please enter valid number!';
                    $this->view->render('templates/notice', $data);
                    return FALSE;
                }
                
                // check if symbol is real
                if (!$stock = lookup($_POST['symbol'])) {
                    $data['message'] = 'You have submitted invalid symbol!';
                    $this->view->render('templates/notice', $data);
                    return FALSE;
                }
                
                //preparing to buy, gathering data
                $id = Session::get('id');
                $cash = $this->model->get_cash($id);
                $amount = $this->model->get_amount($stock, $cash);
                
                //check if user has enough funds
                if ($amount === FALSE) {
                    $data['message'] = 'You do not have enough cash to perform this operation!';
                    $this->view->render('templates/notice', $data);
                    return FALSE;
                }
                
                //buying our shares finally!!!
                $this->model->buy($id);
                $this->model->update_cash($id, $amount);
                $this->model->update_history($id, $_POST['shares'], $stock['price'], $amount, 'BUY');
                
                //preparing to display history table to user
                $data = $this->model->get_history($id);
                $this->view->render('history/history', $data);
            } else {
                $this->view->render('stock/buy');
            }
        }
    }
    
    public function history() {
        if (Session::get('logged_in') === FALSE) {
            $this->view->render('index/index');
            return FALSE;
        }
        
        $id = Session::get('id');
        $data = $this->model->get_history($id);
        $this->view->render('history/history', $data);
    }
    
    public function get_sell() {
        if (Session::get('logged_in') === FALSE) {
            $this->view->render('index/index');
            return FALSE;
        }
        
        $id = Session::get('id');
        $data = $this->model->get_shares_for_sell($id);
        $this->view->render('stock/sell', $data);
    }
    
    public function sell() {
        if (Session::get('logged_in') === FALSE) {
            $this->view->render('index/index');
            return FALSE;
        }
        
        if(isset($_POST['symbol'])) {
            if(!empty($_POST['symbol'])) {
                $stock = lookup($_POST['symbol']);
                $id = Session::get('id');
                $array = $this->model->sell_shares($id, $stock['symbol'], $stock['price']);                
                $amount = $array['shares_cost'] * (-1);
                $this->model->update_cash($id, $amount);
                $this->model->update_history($id, $array['shares_number'], $stock['price'], $array['shares_cost'], 'SELL');
                $data = $this->model->get_history($id);
                $this->view->render('history/history', $data);
            } 
        } else {
            $data['message'] = 'Please, select symbol of shares you want to sell!';
            $this->view->render('templates/notice', $data);
        }
    }

}

