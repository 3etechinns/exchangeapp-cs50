<table class="table table-striped">

    <thead>
        <tr>
            <td><strong>Transaction Type</strong></td>
            <td><strong>Symbol</strong></td>
            <td><strong>Shares</strong></td>
            <td><strong>Price</strong></td>
	    <td><strong>Cost</strong></td>
	    <td><strong>Date/Time</strong></td>
        </tr>
    </thead>
    <tbody>
<?php if (isset($data)) : ?>
<?php foreach($data as $array) {
  
            echo("<tr>");
            echo("<td>" . $array["transaction"] . "</td>");
            echo("<td>" . $array["symbol"] . "</td>");
            echo("<td>" . $array["shares"] . "</td>");
            echo("<td>$" . number_format($array["price"], 2) . "</td>");
            echo("<td>$" . number_format($array["cost"], 2) . "</td>");
	    echo("<td>" . date('d/m/y, g:i A',strtotime($array["time"])) . "</td>");
            echo("</tr>");

} ?>
<?php endif; ?>

    </tbody>
    
</table>