<?php if (isset($profit)) : ?>
<table class="table table-striped">
    <thead>
        <tr>
            <td><strong>Symbol</strong></td>
            <td><strong>Shares</strong></td>
            <td><strong>Price</strong></td>
            <td><strong>TOTAL</strong></td>
	</tr>
    </thead>
    <tbody>
        <tr>
	    <?php foreach ($data as $position): ?>
            <?php if (count($position) == 5) : ?>
	    <td><?= $position["symbol"] ?></td>
            <td><?= $position["shares"] ?></td>
            <td><?= number_format($position["price"], 2, ".", " ") ?>$</td>
	    <td><?= number_format($position["cost"], 2, ".", " ") ?>$</td>
	</tr>
            <?php endif; ?>
            <?php endforeach; ?>
    <tr>
        <td>Cash</td>
	<td></td>
	<td></td>
        <td><?= number_format($cash, 2, ".", " ") ?>$</td>
    </tr>
    <tr>
        <td>Balance</td>
	<td></td>
	<td></td>
        <td><?= number_format($profit, 2, ".", " ") ?>$</td>
    </tr>
    </tbody>
</table>
<?php endif; ?>

