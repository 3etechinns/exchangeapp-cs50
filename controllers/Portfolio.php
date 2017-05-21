<?php

class Portfolio extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        //security check
        if (Session::get('logged_in') === FALSE) {
            $this->view->render('index/index');
            return FALSE;
        }
        //retrieving data from our tables
        $id = Session::get('id');
        $shares = $this->model->get_portfolio($id);
        $cash = $this->model->get_cash($id);
        //calculating totals and total profit of account
        $total = 0;
        foreach($shares as $share) {
            $total += $share['cost'];
        }
	$profit = $total + $cash;
        //converting data into array to pass it later
        $info = array('cash' => $cash, 'profit' => $profit);
        //displaying portfolio with recieved information
        $data = array_merge($shares, $info);
        $this->view->render('login/portfolio', $data);
    }

}

